<?php
use App\Http\Controllers\API\LettersController;
use App\Http\Controllers\API\MdLettersController;
use App\Http\Controllers\API\UsersController;
use App\Http\Controllers\API\MdCompaniesController;


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
// // Route::get('/letters/{id}', [LettersController::class, 'filter']);
// // Route::get('/letters',[MdLettersController::class, 'all']);
// // //post data
// // Route::post('/letters/{id}',[LettersController::class, 'addLetter']);
// // //update database
// // Route::put('letters/{idletter}/{id}',[LettersController::class, 'updateLetter']);
// // //delete data
// // Route::delete('/letters/{idletter}/{id}', [LettersController::class,'deleteLetter']);

// //  Route::get('/logout', [AuthController::class, 'logout']);

    
//  });
//get data


Route::post('/auth/login', [UsersController::class, 'login']);
Route::group(['middleware' => ['auth:sanctum','checkrole:admin,super_admin','cors']], function () {
    Route::get('/profile', function(Request $request) {
        return auth()->user();
    });

    Route::get('/letters/{id}', [LettersController::class, 'all']);
    
    Route::get('/letters',[MdLettersController::class, 'all']);
    //post data
    Route::post('/letters/{id}',[LettersController::class, 'addLetter']);
    //update database
    Route::put('letters/{idletter}',[LettersController::class, 'updateLetter']);
    //delete data
    Route::delete('/letters/{id}', [LettersController::class,'deleteLetter']);

    Route::post('/logout', [UsersController::class, 'logout']);

    Route::get('companies',[MdCompaniesController::class, 'all']);
  
    
});

Route::post('/users', [UsersController::class, 'addUser'])->middleware( ['auth:sanctum','checkrole:super_admin','cors']);
Route::get('/users', [UsersController::class, 'all'])->middleware( ['auth:sanctum','checkrole:super_admin','cors']);

















