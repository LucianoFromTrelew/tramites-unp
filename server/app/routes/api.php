<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

// Categorias
Route::get('categorias/{categoria}/tramites', 'CategoriaController@tramites');
Route::apiResource('categorias', 'CategoriaController');

// Documentos
Route::apiResource('documentos', 'DocumentoController');

// Requerimientos
Route::apiResource('requerimientos', 'RequerimientoController');

// Etiquetas
Route::get('etiquetas/{etiqueta}/tramites', 'EtiquetaController@tramites');
Route::apiResource('etiquetas', 'EtiquetaController');

// Metodos
Route::apiResource('metodos', 'MetodoController');

//Tramites
Route::get('tramites/{tramite}/metodos', 'TramiteController@metodos');
Route::get('tramites/{tramite}/pasos/{metodo}', 'TramiteController@pasos');
Route::get('tramites/{tramite}/documentos', 'TramiteController@documentos');
Route::get('tramites/{tramite}/requerimientos', 'TramiteController@requerimientos');
Route::get('tramites/{tramite}/etiquetas', 'TramiteController@etiquetas');
Route::post('tramites/{tramite}/documentos', 'TramiteController@documento_store');
Route::post('tramites/{tramite}/requerimientos', 'TramiteController@requerimiento_store');
Route::post('tramites/{tramite}/etiquetas', 'TramiteController@etiqueta_store');
Route::delete('tramites/{tramite}/documentos', 'TramiteController@documento_destroy');
Route::delete('tramites/{tramite}/requerimientos', 'TramiteController@requerimiento_destroy');
Route::delete('tramites/{tramite}/etiquetas', 'TramiteController@etiqueta_destroy');
Route::apiResource('tramites', 'TramiteController');

//-----------------------------------------------------------------------------

Route::get('coso', function() {
    return "<form method='post'><input name='email' /> <input name='password' /> <input type='submit' /></form>";
});
Route::post('coso', function(Request $request) {
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        return "logged in!";
    }

    return "not logged in :/";
})->name('login');
