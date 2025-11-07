<?php

namespace Modules\SIGAC\Exports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Modules\SIGAC\Exports\Sheets\FichaDetailSheet;
use Modules\SIGAC\Exports\Sheets\FichaSummarySheet;

class FichaScheduleExport implements WithMultipleSheets
{
    public function __construct(
        protected string $ficha,
        protected array $instructorIds = [],
        protected array $meta = []
    ) {
        $this->instructorIds = array_filter($this->instructorIds ?? [], fn($v) => !empty($v));
    }

    public function sheets(): array
    {
        return [
            new FichaDetailSheet($this->ficha, $this->instructorIds, $this->meta),
            new FichaSummarySheet($this->ficha, $this->instructorIds, $this->meta),
        ];
    }
}
