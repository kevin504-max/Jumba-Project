<?php
namespace App\Repositories;

use App\Models\DadosB3;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class DadosB3Repository
{

    public function __construct()
    {
        //
    }

    public function index(): LengthAwarePaginator
    {
        return DadosB3::paginate();
    }

    public static function getActiveDadosB3($columns = ["id", "name"]): Collection
    {
        return DadosB3::active()->get($columns);
    }

    public static function store($arrayData)
    {
        return DadosB3::create($arrayData);
    }

    public static function update($arrayData, $dadosB3): bool
    {
        return $dadosB3->update($arrayData);
    }

    public static function destroy($dadosB3): bool
    {
        return $dadosB3->delete();
    }

    public static function chartDados($request)
    {
        $calc = DB::raw("ROUND((sum(TradAvrgPric)/count(TradAvrgPric)), 2) as preco_medio");
        $dadosB3 = DB::table("dados_b3")->select("Asst as ativo_papel", $calc)
        ->groupBy("Asst")->orderBy("Asst", "DESC")
        ->skip($request["page"])->take($request["size"]);

        if ($request["ativo"] && array_key_exists("ativo", $request->all())) {
            $dadosB3->where("Asst", $request["ativo"]);
        }

        return $dadosB3->get();
    }

    public static function chartDadosTotal()
    {
        return DB::table("dados_b3")->select(
            "Asst as ativo_papel", DB::raw("ROUND((sum(TradAvrgPric)/count(TradAvrgPric)), 2) as preco_medio")
        )->groupBy("Asst")->orderBy("Asst", "DESC")->get();
    }

}

?>
