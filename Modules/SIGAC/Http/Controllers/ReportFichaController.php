<?php

namespace Modules\SIGAC\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Maatwebsite\Excel\Facades\Excel;
use Modules\SIGAC\Exports\FichaScheduleExport;
use Modules\SIGAC\Exports\Sheets\FichaDetailSheet;
use Illuminate\Support\Carbon;


class ReportFichaController extends Controller
{
    /* ===== Helpers de detección ===== */

    // Columna de ficha en courses
    protected function detectCourseFichaColumn(): string
    {
        $candidates = ['ficha_code', 'ficha', 'code', 'course_code'];
        foreach ($candidates as $c) {
            if (Schema::hasColumn('courses', $c)) {
                return $c;
            }
        }
        return 'id'; // último recurso
    }

    // Expresión SQL para nombre del programa desde programs
    protected function detectProgramExpr(): string
    {
        if (!Schema::hasTable('programs')) {
            return 'NULL';
        }

        $cols = Schema::getColumnListing('programs');
        $cands = ['name', 'program_name', 'nombre_programa', 'programa_formacion', 'titulo', 'nombre'];

        $present = array_values(array_filter($cands, fn($c) => in_array($c, $cols)));
        if (empty($present)) {
            $first = $cols[0] ?? null;
            if (!$first) return 'NULL';
            $present = [$first];
        }

        $parts = array_map(fn($c) => "pr.{$c}", $present);
        return 'COALESCE(' . implode(', ', $parts) . ')';
    }


    /* ===== VISTA DEL FORMULARIO ===== */

    public function form()
    {
        $fichaCol = $this->detectCourseFichaColumn();

        $fichas = DB::table('courses as c')
            ->join('instructor_programs as ip', 'ip.course_id', '=', 'c.id')
            ->select("c.{$fichaCol} as ficha")
            ->distinct()
            ->orderBy('ficha')
            ->pluck('ficha');

        return view('sigac::reports.cronograma.ficha_form', [
            'fichas'    => $fichas,
            'titlePage' => 'Reportes de Cronograma',
            'titleView' => 'Reportes de Cronograma',
        ]);
    }

    /* ===== EXPORTAR EXCEL ===== */

    public function export(Request $request)
    {
        $request->validate([
            'ficha'        => ['required', 'string', 'max:100'],
            'instructors'  => ['array'],
            'instructors.*' => ['integer'],
        ]);

        $fichaCol       = $this->detectCourseFichaColumn();
        $programExpr    = $this->detectProgramExpr();
        $loCompetExpr   = $this->detectLOCompetenceExpr();
        $ficha          = trim($request->input('ficha'));
        $instructorIds  = $request->input('instructors', []);

        // Nombre del programa para el nombre del archivo
        $program = DB::table('courses as c')
            ->join('programs as pr', 'pr.id', '=', 'c.program_id')
            ->where("c.{$fichaCol}", $ficha)
            ->selectRaw("{$programExpr} as program_name")
            ->value('program_name');

        $file = 'Cronograma_' . preg_replace('/[^A-Za-z0-9_\-]/', '_', $ficha);
        if ($program) {
            $file .= '_' . preg_replace('/[^A-Za-z0-9_\-]/', '_', $program);
        }
        $file .= '.xlsx';

        return Excel::download(
            new FichaScheduleExport(
                ficha: $ficha,
                instructorIds: $instructorIds,
                meta: [
                    'fichaCol'         => $fichaCol,
                    'programExpr'      => $programExpr,
                    'loCompetenceExpr' => $loCompetExpr,   // 👈 importante
                ]
            ),
            $file
        );
    }
    protected function detectLOCompetenceExpr(): string
    {
        if (!\Schema::hasTable('learning_outcomes')) {
            return "'—'";
        }

        $cols = \Schema::getColumnListing('learning_outcomes');

        // 1. Campos típicos de competencia
        foreach (['competence_name', 'competence', 'competencia', 'competency'] as $c) {
            if (in_array($c, $cols)) {
                return "COALESCE(lo.{$c}, '—')";
            }
        }

        // 2. Cualquier columna que tenga "competenc" en el nombre
        foreach ($cols as $c) {
            if (stripos($c, 'competenc') !== false) {
                return "COALESCE(lo.{$c}, '—')";
            }
        }

        // 3. Si hay código, úsalo como competencia
        foreach (['code', 'codigo', 'cod_competencia'] as $c) {
            if (in_array($c, $cols)) {
                return "COALESCE(lo.{$c}, '—')";
            }
        }

        // 4. Último recurso: usa el mismo nombre del RA
        if (in_array('name', $cols)) {
            return "COALESCE(lo.name, '—')";
        }

        return "'—'";
    }
    public function preview(Request $request)
    {
        $request->validate([
            'ficha'         => ['required', 'string', 'max:100'],
            'instructors'   => ['array'],
            'instructors.*' => ['integer'],
        ]);

        $fichaCol      = $this->detectCourseFichaColumn();
        $programExpr   = $this->detectProgramExpr();
        $ficha         = trim($request->input('ficha'));
        $instructorIds = $request->input('instructors', []);

        // Misma query que la hoja "Detalle"
        $sheet = new FichaDetailSheet(
            ficha: $ficha,
            instructorIds: $instructorIds,
            meta: [
                'fichaCol'    => $fichaCol,
                'programExpr' => $programExpr,
            ]
        );

        $rows = $sheet->query()->get();

        // 🔹 Formateamos igual que en el Excel
        $data = $rows->map(function ($r) {
            return [
                'instructor'   => $r->instructor,
                'competencia'  => $r->competencia,
                'ra'           => $r->ra,
                'ficha'        => $r->ficha,
                'programa'     => $r->programa,
                'trimestre'    => $r->trimestre,

                // Horas sin decimales (8, 63, etc.)
                'horas_clase'  => (int) $r->horas_clase,

                // Fecha (clase) -> solo YYYY-MM-DD
                'fecha_clase'  => $r->fecha_clase
                    ? Carbon::parse($r->fecha_clase)->format('Y-m-d')
                    : null,

                // Horas inicio/fin -> HH:MM
                'hora_inicio'  => $r->hora_inicio
                    ? substr($r->hora_inicio, 0, 5)   // "07:15:00" -> "07:15"
                    : null,
                'hora_fin'     => $r->hora_fin
                    ? substr($r->hora_fin, 0, 5)
                    : null,

                // Primera / Última clase -> igual que en el Excel
                'fecha_inicio' => $r->fecha_inicio
                    ? Carbon::parse($r->fecha_inicio)->format('Y-m-d')
                    : null,
                'fecha_final'  => $r->fecha_final
                    ? Carbon::parse($r->fecha_final)->format('Y-m-d')
                    : null,
            ];
        });

        return response()->json($data->values());
    }
    public function buscarFichaAjax(Request $request)
    {
        $search = trim($request->get('q'));
        $fichaCol = $this->detectCourseFichaColumn();

        $query = DB::table('courses as c')
            ->join('instructor_programs as ip', 'ip.course_id', '=', 'c.id')
            ->select("c.{$fichaCol} as ficha")
            ->distinct()
            ->orderBy('ficha');

        if ($search) {
            $query->where("c.{$fichaCol}", 'like', "%{$search}%");
        }

        $fichas = $query->pluck('ficha')->map(fn($f) => ['id' => $f, 'text' => $f]);

        return response()->json(['results' => $fichas]);
    }
    public function instructorsByFicha(string $ficha)
{
    $fichaCol = $this->detectCourseFichaColumn();

    $rows = DB::table('people as p')
        ->selectRaw("
            p.id,
            TRIM(CONCAT_WS(' ', p.first_name, p.first_last_name, NULLIF(p.second_last_name, ''))) as name
        ")
        ->whereExists(function ($q) use ($fichaCol, $ficha) {
            $q->from('instructor_program_people as ipp')
                ->join('instructor_programs as ip', 'ip.id', '=', 'ipp.instructor_program_id')
                ->join('courses as c', 'c.id', '=', 'ip.course_id')
                ->whereColumn('ipp.person_id', 'p.id')
                ->where("c.{$fichaCol}", $ficha)
                ->whereNull('ipp.deleted_at');
        })
        ->orderBy('name')
        ->distinct()
        ->get();

    return response()->json($rows);
}
}
