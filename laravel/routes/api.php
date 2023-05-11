<?php

use App\Http\Controllers\DadosB3Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('leding/getDataB3', [DadosB3Controller::class, "getDadosB3"]);
Route::get('leding/chart', [DadosB3Controller::class, "chartDados"]);
Route::resource('leding', DadosB3Controller::class);

Route::middleware("auth:sanctum")->get("/user", function (Request $request) {
    return $request->user();
});
