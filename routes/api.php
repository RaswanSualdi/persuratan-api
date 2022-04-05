<?php
use App\Http\Controllers\API\LettersController;
// use App\Http\Controllers\API\KodeSuratController;
// use App\Http\Controllers\API\KodeSuratLembagaController;

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
Route::post('/letters',[LettersController::class, 'addLetter']);
//get data
Route::get('/letters', [LettersController::class, 'all']);
//update database
// Route::put('letters/letter/{idletter}',[LettersController::class, 'updateFormat']);










