<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {
    return view('welcome');
});

Route::get('/atendimento', function () {
    return view('audio.index');
});


Auth::routes();

Route::group(['prefix' => 'admin','middleware' => 'auth','namespace' => 'Admin'],function(){
    Route::get('/', 'IndexController@index')->name('home');
    Route::get('/home', 'IndexController@index')->name('home');

    //ArquivoSigep
    Route::get('arquivo_sigep', 'ArquivoSigepController@index')->name('admin.arquivo_sigep.index');
    Route::get('arquivo_sigep/create', 'ArquivoSigepController@create')->name('admin.arquivo_sigep.create');
    Route::post('arquivo_sigep/store', 'ArquivoSigepController@store')->name('admin.arquivo_sigep.store');
    Route::get('arquivo_sigep/import/{id}', 'ArquivoSigepController@import')->name('admin.arquivo_sigep.import');
    Route::get('arquivo_sigep/show/{id}', 'ArquivoSigepController@show')->name('admin.arquivo_sigep.show');
    Route::put('arquivo_sigep/update/{id}', 'ArquivoSigepController@update')->name('admin.arquivo_sigep.update');
    Route::delete('arquivo_sigep/destroy/{id}', 'ArquivoSigepController@destroy')->name('admin.arquivo_sigep.destroy');
    
   
    //Galeria
    Route::get('galeria', 'GaleriaController@index')->name('admin.galeria.index');
    Route::get('galeria/create', 'GaleriaController@create')->name('admin.galeria.create');
    Route::post('galeria/store', 'GaleriaController@store')->name('admin.galeria.store');
    Route::get('galeria/edit/{id}', 'GaleriaController@edit')->name('admin.galeria.edit');
    Route::get('galeria/show/{id}', 'GaleriaController@show')->name('admin.galeria.show');
    Route::put('galeria/update/{id}', 'GaleriaController@update')->name('admin.galeria.update');
    Route::delete('galeria/destroy/{id}', 'GaleriaController@destroy')->name('admin.galeria.destroy');
    Route::get('galerias', 'GaleriaController@galerias')->name('admin.galeria.galerias');
    Route::get('galeria/{id}', 'GaleriaController@galeria')->name('admin.galeria.galeria');

     //Presos
    Route::get('preso', 'PresoController@index')->name('admin.preso.index');
    Route::get('preso/por_cubiculo', 'CubiculoController@presosPorCubiculo')->name('admin.preso.por_cubiculo');


});
