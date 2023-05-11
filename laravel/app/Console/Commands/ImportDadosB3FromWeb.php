<?php

namespace App\Console\Commands;

use DateInterval;
use DatePeriod;
use DateTime;
use Illuminate\Console\Command;

class ImportDadosB3FromWeb extends Command
{

    protected $signature = 'app:import-dados-b3-from-web';

    public function handle()
    {
        return app('App\Http\Controllers\DadosB3Controller')->getDadosB3();
    }

    public function loadRange($initialDate, $finalDate)
    {
        $initialDate = new DateTime($initialDate);
        $finalDate = new DateTime($finalDate);

        $range = new DateInterval("P1D");

        $period = new DatePeriod($initialDate, $range, $finalDate);

        $businessDays = 0;
        $listBusinessDays = array();

        foreach ($period as $date) {
            if ($date->format("N") < 6) {
                $businessDays++;
                $this->getDadosFromWeb("", $date->format("Y-m-d"));
            }
        }

        echo "Dias úteis do mês atual: " . $businessDays . "\n";
        return $listBusinessDays;
    }
}
