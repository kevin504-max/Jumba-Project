<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DadosB3 extends Model
{
    use HasFactory;

    protected $table = "dados_b3";
    protected $primaryKey = "id_open_position";
    public $timestamps = false;
    protected $guarded = ["id_open_position"];

    protected $fillable = [
        "RptDt",
        "TckrSymb",
        "Asst",
        "BalQty",
        "TradAvrgPric",
        "PricFctr",
        "BalVal"
    ];
}
