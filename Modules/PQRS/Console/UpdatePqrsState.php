<?php

namespace Modules\PQRS\Console;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Modules\PQRS\Entities\Pqrs;
use Modules\SICA\Entities\Holiday;
use Carbon\Carbon;

class UpdatePqrsState extends Command
{
    protected $signature = 'pqrs:update-state';
    protected $description = 'Actualizar el estado de los PQRS que están próximos a vencer';

    public function __construct()
    {
        parent::__construct();
    }

    
    public function handle()
    {
        try {
            $pqrs = Pqrs::all();
            $holidays = Holiday::pluck('date')->map(function ($date) {
                return Carbon::parse($date)->format('Y-m-d');
            })->toArray();
            
            foreach ($pqrs as $p) {
                $end_date = Carbon::parse($p->end_date);
                $diff = Carbon::now()->diffInDays($end_date, false);
                
                $current_date = Carbon::now();
                $days_remaining = 0;
                $weekend_days = 0;
                $holiday_days = 0;
        
                // Contar los días excluyendo los días feriados
                while ($current_date->lessThanOrEqualTo($end_date)) {
                    if ($current_date->isWeekend() || in_array($current_date->format('Y-m-d'), $holidays)) {
                        if ($current_date->isWeekend()) {
                            $weekend_days++;
                        }
                        if (in_array($current_date->format('Y-m-d'), $holidays)) {
                            $holiday_days++;
                        }
                    } else {
                        $days_remaining++;
                    }
                    $current_date->addDay();
                }
                
                // Verificar si el estado debe ser actualizado
                if ($days_remaining == 5) {
                    $p->state = 'PROXIMO A VENCER';
                    $p->save();
                }                 
            }
        } catch (Exception $e) {
            dd('Error al actualizar el estado de los PQRS: ' . $e->getMessage());
        }
    }
}
