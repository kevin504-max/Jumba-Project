<?php

namespace App\Http\Controllers;

use App\Http\Requests\DadosB3Request;
use App\Http\Controllers\Controller;

use App\Http\Resources\DadosB3Resource;
use App\Models\DadosB3;
use App\Services\DadosB3Service;
use Illuminate\Http\Request;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class DadosB3Controller extends Controller
{

    private $dadosB3Service;

    public function __construct(DadosB3Service $dadosB3Service)
    {
        $this->dadosB3Service = $dadosB3Service;
    }

    public function initialization()
    {
        $securityLending = new DadosB3Service();

        return DadosB3Resource::collection($securityLending->initialize());
    }


    public function index()
    {
        return DadosB3Resource::collection($this->dadosB3Service->index());
    }

    public function store(Request $request)
    {
        $dados = $request->all();
        $response = $this->formatation($dados);

        $results = collect($response)->map(function ($dado) {
            return $this->dadosB3Service->store($dado);
        });

        return response()->json($results);
    }

    public function storeDadoB3($arrayData)
    {
        $dadosB3 = new Request($arrayData);
        $response = [];

        foreach ($dadosB3->all() as $dado) {
            $response[] = $this->dadosB3Service->store($dado);
        }

        return response()->json($response);
    }

    public function show(DadosB3 $dado)
    {
        return new DadosB3Resource($dado);
    }

    public function update(DadosB3Request $request, DadosB3 $dado)
    {
        $securityLending = new DadosB3Service();
        $dadosB3 = $securityLending->update($request->validated(), $dado);

        return ($dadosB3) ? new DadosB3Resource(($dado)) : response()->json([], 202);
    }

    public function destroy(DadosB3 $dado)
    {
        $securityLending = new DadosB3Service();
        $securityLending->destroy($dado);

        return response()->json("Deletado com sucesso!");
    }

    public function formatation($arrayData)
    {
        $this->saveFile("storage/app/public/", "dadosB3.json", $arrayData);
        $response = array();

        foreach($arrayData[0]["columns"] as $index => $column) {
            foreach ($arrayData[0]["values"] as $key => $value) {
                $response[$key][$column["name"]] = $value[$index];
            }
        }

        return $response;
    }

    public function getDadosB3()
    {
        echo "Carregando...";
        try {
            $dayBusinessList = $this->getTwentyPreviousBusinessDays();
            $page = 1;

            foreach ($dayBusinessList as $day) {
                echo ".";
                $response[$day] = $this->loadPages($day, $page);
            }

            $this->saveFile("storage/app/public/", "dadosB3.json", $response);
        } catch (\Throwable $th) {
            echo "\n" . $th->getMessage() . "\n";
        }
        echo "Fim da execução!";
    }

    public function getTwentyPreviousBusinessDays()
    {
        $dateNow = date("Y-m-d");
        $daysAgo = strtotime("-5 weekdays", strtotime($dateNow));
        $businessDays = array();

        for ($i = $daysAgo; $i <= strtotime($dateNow); $i = strtotime("+1 weekdays", $i)) {
            $businessDays[] = date("Y-m-d", $i);
        }

        return $businessDays;

    }

    public function saveFile($path = "storage/app/public", $filename = "dadosB3.json", $data = null)
    {
        $filepath = $path . "/" . $filename;
        $result = file_put_contents($filepath, json_encode($data));
    }

    public function loadPages($date, $initialPage)
    {
        $results = array();
        $totalPages = null;

        do {
            echo ".";
            $response = $this->getDadosFromWeb("https://arquivos.b3.com.br/tabelas/table/LendingOpenPosition/$date/$initialPage");

            if ($response && !$totalPages) {
                $totalPages = array_key_exists('pageCount', $response) ? $response['pageCount'] : null;
            }

            $formattedData[0] = $response;
            $initialPage++;
            $formattedResult = $this->formatation($formattedData);
            $this->storeDadoB3($formattedResult);
            $results[] = $formattedResult;
        } while ($initialPage < $totalPages);

        return $results;
    }

    public function getDadosFromWeb($url)
    {
        $client = new Client();
        $options = [
            "http_errors" => true,
            "force_ip_resolve" => "v4",
            "connect_timeout" => 120,
            "read_timeout" => 120,
            "timeout" => 120
        ];

        $response = $client->request("GET", $url, $options);
        return json_decode($response->getBody(), true);
    }

    public function chartDados(Request $request)
    {
        $securityLending = new DadosB3Service();
        $response = $securityLending->chartDados($request);

        $chartData = [];

        foreach (json_decode($response, true) as $item) {
            $chartData[] = array("columns" => $item["ativo_papel"], "value" => $item["preco_medio"]);
        }

        $chartData["totalledings"] = ($request["ativo"] && array_key_exists("ativo", $request->all()))
            ? 1
            : sizeof(json_decode($securityLending->chartDadosTotal()));

        return $chartData;
    }
}
