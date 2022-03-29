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
Route::post('letters/letter/{idletter}',[FormatSuratController::class, 'letter']);
//update database
Route::put('letters/letter/{idletter}',[FormatSuratController::class, 'updateFormat']);

//index data
Route::prefix('md')->group(function (){
    Route::get('/letters',[KodeSuratController::class, 'all']);
    Route::get('/companies', [KodeSuratLembagaController::class, 'all']); 
});

Route::get('/letters',[FormatSuratController::class, 'all']);





