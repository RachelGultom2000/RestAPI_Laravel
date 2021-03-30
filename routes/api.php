<?php

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

Route::post('/v1/wisatas/store', [App\Http\Controllers\api\v1\WisatasController::class, 'store']);
Route::get('/v1/wisatas', [App\Http\Controllers\api\v1\WisatasController::class, 'index']);
Route::get('/v1/wisatas/{id?}', [App\Http\Controllers\api\v1\WisatasController::class, 'show']);
Route::post('/v1/wisatas/update',[App\Http\Controllers\api\v1\WisatasController::class, 'update']);
Route::delete('/v1/wisatas/{id?}',[App\Http\Controllers\api\v1\WisatasController::class, 'destroy']);
