<?php
use App\Http\Controllers\API\FormatSuratController;
use App\Http\Controllers\API\KodeSuratController;
use App\Http\Controllers\API\KodeSuratLembagaController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('format/{idkodesurat}/{idkodelembaga}',[FormatSuratController::class, 'format']);
Route::get('kodesurat',[KodeSuratController::class,'getAll']);
Route::get('kodesuratlembaga',[KodeSuratLembagaController::class,'getAll']);

//index data
Route::get('indexFormat',[FormatSuratController::class, 'indexFormat']);
Route::get('indexKodeSurat',[KodeSuratController::class, 'indexKodeSurat']);
Route::get('indexKodeSuratLembaga', [KodeSuratLembagaController::class, 'indexKodeSuratLembaga']);

//update data
Route::post('updateFormat/{idformat}',[FormatSuratController::class, 'updateFormat']);

