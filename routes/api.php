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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

//post data
Route::post('format/kode-surat/{idkodesurat}/kode-lembaga/{idkodelembaga}',[FormatSuratController::class, 'format']);

// get data by id
Route::get('/kode-surat',[KodeSuratController::class,'getDataById']);
Route::get('/kode-surat-lembaga',[KodeSuratLembagaController::class,'getDataById']);


//index data
Route::prefix('index')->group(function (){
    Route::get('/format-surat',[FormatSuratController::class, 'indexFormat']);
    Route::get('/kode-surat',[KodeSuratController::class, 'indexKodeSurat']);
    Route::get('/kode-surat-lembaga', [KodeSuratLembagaController::class, 'indexKodeSuratLembaga']); 
});


//update data
Route::post('update/format-surat/{idformat}',[FormatSuratController::class, 'updateFormat']);

