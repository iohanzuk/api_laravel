<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DeveloperController;

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

Route::get('/developers', [DeveloperController::class, 'get']);
Route::post('/developers', [DeveloperController::class, 'store']);

Route::put('/developers/{id}', [DeveloperController::class, 'edit']);
Route::get('/developers/{id}', [DeveloperController::class, 'getById']);
Route::delete('/developers/{id}', [DeveloperController::class, 'delete']);

