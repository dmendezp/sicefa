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

class FichaDetailSheet implements FromQuery, WithMapping, WithHeadings, ShouldAutoSize, WithColumnFormatting, WithTitle
{
    public function __construct(
        protected string $ficha,
        protected array $instructorIds = [],
        protected array $meta = []
    ) {}

    public function title(): string { return 'Detalle'; }

    public function query()
    {
        $fichaCol    = $this->meta['fichaCol'] ?? 'id';
        $programExpr = $this->meta['programExpr'] ?? 'NULL';

        $displayExpr = "TRIM(CONCAT_WS(' ', p.first_name, p.first_last_name, NULLIF(p.second_last_name, '')))";

        return DB::table('courses as c')
            ->join('programs as pr', 'pr.id', '=', 'c.program_id')
            ->join('instructor_programs as ip', 'ip.course_id', '=', 'c.id')
            ->join('instructor_program_people as ipp', 'ipp.instructor_program_id', '=', 'ip.id')
            ->join('people as p', 'p.id', '=', 'ipp.person_id')
            ->leftJoin('instructor_program_outcomes as ipo', function ($j) {
                $j->on('ipo.instructor_program_id', '=', 'ip.id')
                  ->whereNull('ipo.deleted_at');
            })
            ->leftJoin('learning_outcomes as lo', 'lo.id', '=', 'ipo.learning_outcome_id')
            // 👇 aquí la unión correcta con competencies (fíjate en competencie_id)
            ->leftJoin('competencies as co', 'co.id', '=', 'lo.competencie_id')
            ->selectRaw("
                {$displayExpr} as instructor,
                COALESCE(co.name, '—') as competencia,
                COALESCE(lo.name, '—') as ra,
                c.{$fichaCol} as ficha,
                {$programExpr} as programa,
                ip.quarter_number as trimestre,
                ip.date as fecha_clase,
                ip.start_time as hora_inicio,
                ip.end_time as hora_fin,
                ROUND(TIMESTAMPDIFF(MINUTE, ip.start_time, ip.end_time)/60, 2) as horas_clase,
                (SELECT MIN(ip2.date) FROM instructor_programs ip2 WHERE ip2.course_id = c.id) as fecha_inicio,
                (SELECT MAX(ip3.date) FROM instructor_programs ip3 WHERE ip3.course_id = c.id) as fecha_final
            ")
            ->where("c.{$fichaCol}", $this->ficha)
            ->whereNull('ipp.deleted_at')
            ->when(!empty($this->instructorIds), fn($q) => $q->whereIn('p.id', $this->instructorIds))
            ->orderByRaw('CAST(ip.quarter_number AS UNSIGNED) asc')
            ->orderBy('ip.date')
            ->orderBy('ip.start_time');
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
            (int)$r->horas_clase,
            $r->fecha_clase,
            $r->hora_inicio,
            $r->hora_fin,
            $r->fecha_inicio,
            $r->fecha_final,
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
            'Horas (clase)',
            'Fecha (clase)',
            'Hora inicio',
            'Hora fin',
            'Primera clase (ficha)',
            'Última clase (ficha)',
        ];
    }

    public function columnFormats(): array
    {
        return [
            'G' => NumberFormat::FORMAT_NUMBER,
            'H' => NumberFormat::FORMAT_DATE_YYYYMMDD,
            'K' => NumberFormat::FORMAT_DATE_YYYYMMDD,
            'L' => NumberFormat::FORMAT_DATE_YYYYMMDD,
        ];
    }
}
