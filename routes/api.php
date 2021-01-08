<?php

use App\Http\Controllers\Api\Content\ContentController;
use App\Http\Controllers\Api\Subcription\UserSubcriptionController;
use App\Http\Controllers\Api\User\LoginController;
use App\Http\Controllers\Api\User\ProfileController;
use App\Http\Controllers\Api\User\UserController;
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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::namespace('Api')->group(function () {
    Route::get('/profile/{id}', [ProfileController::class, 'show']);
    Route::get('/users', [UserController::class, 'index']);
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/subcription/{id}', [UserSubcriptionController::class, 'show']);
    Route::get('/contents', [ContentController::class, 'index']);
    Route::get('/content', [ContentController::class, 'contentSub']);
});
