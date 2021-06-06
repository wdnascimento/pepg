<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// GET     /jobs           // Returns all jobs
// DELETE  /job/123        // Delete the job with ID 123
// POST    /companies      // Create a new company through post data
// PUT     /companies/123  // Update a company with ID 123

Route::group(['namespace' => 'Api'],function(){

    Route::get('preso/{prontuario}', 'PresoController@index')->name('api.preso.index');
    Route::post('preso/audio', 'PresoController@uploadFile')->name('api.preso.audio');
    Route::post('atendimento', 'AtendimentoController@store')->name('api.atendimento.create');
    Route::post('atendimento/salvaratendimento', 'AtendimentoController@saveAtendimento')->name('api.atendimento.salvar');
    Route::get('setor/listar/{preso_id}', 'SetorController@index')->name('api.setor.listar');
    Route::get('parametro/{titulo}', 'ParametroController@index')->name('api.parametro');

});