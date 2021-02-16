<?php

use App\Mail\NovaSeries;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

Route::get('/', function () {
    return redirect()->route('listar_series');
});

Route::get('/series', 'SeriesController@index')
    ->name('listar_series');

Route::get('/series/criar', 'SeriesController@create')
    ->name('criar_serie')
    ->middleware('autenticador');

Route::post('/series/criar', 'SeriesController@store')
    ->middleware('autenticador');

Route::delete('/series/{id}', 'SeriesController@destroy')
    ->name('excluir_serie')
    ->middleware('autenticador');

Route::post('/series/{id}/editaNome', 'SeriesController@editaNome')
    ->middleware('autenticador');

Route::get('/series/{serieId}/temporadas', 'TemporadasController@index');

Route::get('/temporadas/{temporada}/episodios', 'EpisodiosController@index');

Route::post('/temporadas/{temporada}/episodios/assistir', 'EpisodiosController@assistir')
    ->middleware('autenticador');


Auth::routes();

Route::get('/entrar', 'EntrarController@index');
Route::post('/entrar', 'EntrarController@entrar');

Route::get('/registrar', 'RegistroController@create');
Route::post('/registrar', 'RegistroController@store');
Route::get('/sair', function(){
    Auth::logout();
    return redirect('/entrar');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/mail', function(){
    return new NovaSeries('100');
});

Route::get('/send-mail', function(){
    
    $user = (object)[
        'email' => 'bruno@teste.com',
        'nome' => 'Bruno'
    ];
    
    return 'E-mail enviado!';
});
