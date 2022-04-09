<?php
use App\Http\Controllers\API\LettersController;
use App\Http\Controllers\API\MdLettersController;
use App\Http\Controllers\API\AuthController;


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
// Route::post('/auth/register', [AuthController::class, 'register']);
// Route::post('/auth/login', [AuthController::class, 'login']);

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
    
// });
//get data

Route::get('/letters/{id}', [LettersController::class, 'filter']);
Route::get('/letters',[MdLettersController::class, 'all']);
//post data
Route::post('/letters/{id}',[LettersController::class, 'addLetter']);
//update database
Route::put('letters/letter/{idletter}/{id}',[LettersController::class, 'updateLetter']);

// Route::group(['middleware' => ['auth:sanctum']], function () {
//     Route::get('/profile', function(Request $request) {
//         return auth()->user();
//     });

//     // API route for logout user
//     Route::post('/logout', [App\Http\Controllers\API\AuthController::class, 'logout']);
// });











