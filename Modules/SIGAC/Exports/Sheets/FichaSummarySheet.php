<?php

namespace Modules\SIGAC\Exports\Sheets;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class FichaSummarySheet implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize, WithColumnFormatting, WithTitle
{
    public function __construct(
        protected string $ficha,
        protected array $instructorIds = [],
        protected array $meta = []
    ) {}

    public function title(): string { return 'Resumen'; }

    public function query()
    {
        $fichaCol    = $this->meta['fichaCol'] ?? 'id';
        $programExpr = $this->meta['programExpr'] ?? 'NULL';

        $displayExpr = "TRIM(CONCAT_WS(' ', p.first_name, p.first_last_name, NULLIF(p.second_last_name, '')))";

        // Subconsulta base: una fila por clase
        $base = DB::table('courses as c')
            ->join('programs as pr', 'pr.id', '=', 'c.program_id')
            ->join('instructor_programs as ip', 'ip.course_id', '=', 'c.id')
            ->join('instructor_program_people as ipp', 'ipp.instructor_program_id', '=', 'ip.id')
            ->join('people as p', 'p.id', '=', 'ipp.person_id')
            ->leftJoin('instructor_program_outcomes as ipo', function ($j) {
                $j->on('ipo.instructor_program_id', '=', 'ip.id')
                  ->whereNull('ipo.deleted_at');
            })
            ->leftJoin('learning_outcomes as lo', 'lo.id', '=', 'ipo.learning_outcome_id')
            // 👇 unión correcta: learning_outcomes.competencie_id -> competencies.id
            ->leftJoin('competencies as co', 'co.id', '=', 'lo.competencie_id')
            ->where("c.{$fichaCol}", $this->ficha)
            ->whereNull('ipp.deleted_at')
            ->when(!empty($this->instructorIds), fn($q) => $q->whereIn('p.id', $this->instructorIds))
            ->selectRaw("
                {$displayExpr} as instructor,
                COALESCE(co.name, '—') as competencia,
                COALESCE(lo.name, '—') as ra,
                c.{$fichaCol} as ficha,
                {$programExpr} as programa,
                ip.quarter_number as trimestre,
                ROUND(TIMESTAMPDIFF(MINUTE, ip.start_time, ip.end_time)/60, 2) as horas_clase,
                ip.date as fecha_clase
            ");

        // Resumen: agrupa por Instructor x Competencia x RA x Trimestre
        return DB::query()->fromSub($base, 'X')
            ->selectRaw("
                instructor,
                competencia,
                ra,
                ficha,
                programa,
                trimestre,
                COUNT(*) as clases,
                ROUND(SUM(horas_clase), 2) as horas_dictadas,
                MIN(fecha_clase) as primera_clase,
                MAX(fecha_clase) as ultima_clase
            ")
            ->groupBy('instructor','competencia','ra','ficha','programa','trimestre')
            ->orderByRaw('CAST(trimestre AS UNSIGNED) asc')
            ->orderBy('primera_clase')
            ->orderBy('instructor')
            ->orderBy('competencia')
            ->orderBy('ra');
    }

    public function map($r): array
    {
        return [
            $r->instructor,
            $r->competencia,
            $r->ra,
            $r->ficha,
            $r->programa,
            $r->trimestre,
            (int) $r->clases,
            (int) $r->horas_dictadas,
            $r->primera_clase,
            $r->ultima_clase,
        ];
    }

    public function headings(): array
    {
        return [
            'Instructor',
            'Competencia',
            'Resultado de aprendizaje (RA)',
            'Ficha',
            'Programa',
            'Trimestre',
            'Clases (#)',
            'Horas dictadas',
            'Primera clase',
            'Última clase',
        ];
    }

    public function columnFormats(): array
    {
        return [
            'H' => NumberFormat::FORMAT_NUMBER,
            'I' => NumberFormat::FORMAT_DATE_YYYYMMDD,
            'J' => NumberFormat::FORMAT_DATE_YYYYMMDD,
        ];
    }
}
