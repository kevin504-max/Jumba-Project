<?php

namespace App\Jobs;

use DateInterval;
use DatePeriod;
use DateTime;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class importDadosB3FromWeb implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $initialDate;

    public function __construct()
    {
        $initialDate = new DateTime();
        $this->initialDate = $initialDate->format('Y-m-d');
    }

    public function handle()
    {
        return app('App\Http\Controllers\DadosB3Controller')->getDadosFromWeb();
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
