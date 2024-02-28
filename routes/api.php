<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DataController;
use App\Http\ControllersDataController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::view('/', 'index')->name('home');





Route::post('/saveFamily/{id}', [DataController::class, 'saveFamily']);

Route::post('/savePerson/{id}', [DataController::class, 'savePerson']);

Route::post('/logIn', [DataController::class, 'logIn']);





Route::delete('/deleteCity/{id}', [DataController::class, 'deleteMiasto']);

Route::delete('/deleteFamily/{id}', [DataController::class, 'deleteFamily']);

Route::delete('/deletePerson/{id}', [DataController::class, 'deletePerson']);





Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    echo $request;
    return $request->user();
});



