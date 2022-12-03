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

Route::resource('/test', \App\Http\Controllers\Api\TestController::class);
Route::resource('/question', \App\Http\Controllers\Api\QuestionController::class);
Route::resource('/answer', \App\Http\Controllers\Api\AnswerController::class);
Route::resource('/user-answer', \App\Http\Controllers\Api\UserAnswerController::class);
Route::post('/user-answer/info', [\App\Http\Controllers\Api\UserAnswerController::class, 'infoAll']);
Route::post('/user-answer/info/{id}', [\App\Http\Controllers\Api\UserAnswerController::class, 'info']);
