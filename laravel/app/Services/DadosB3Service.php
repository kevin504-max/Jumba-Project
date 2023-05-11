<?php

namespace App\Services;

use App\Repositories\DadosB3Repository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Class DadosB3Service
 * @package App\Services
 */
class DadosB3Service
{
    public function initialize(): Object
    {
        return new \stdClass();
    }

    public function index(): LengthAwarePaginator
    {
        $dadosB3ServiceRepository = new DadosB3Repository();
        return $dadosB3ServiceRepository->index();
    }

    public function getActiveDadosB3(): Collection
    {
        return DadosB3Repository::getActiveDadosB3();
    }

    public function store(array $request)
    {
        return DadosB3Repository::store($request);
    }

    public function update(array $request, $dadosB3): bool
    {
        return DadosB3Repository::update($request, $dadosB3);
    }

    public function destroy($dadosB3): bool
    {
        return DadosB3Repository::destroy($dadosB3);
    }

    public function chartDados($request)
    {
        return DadosB3Repository::chartDados($request);
    }

    public function chartDadosTotal()
    {
        return DadosB3Repository::chartDadosTotal();
    }
}
