<?php

use App\Http\Controllers\Api\V1\{
    ReviewController,
    UserController,
};
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register',[UserController::class,'register']);
Route::post('/login',[UserController::class,'logIn']);
Route::post('/logout',[UserController::class,'logOut'])->middleware('auth:sanctum');
Route::apiResource('users', UserController::class)->only('index','show');
Route::apiResource('reviews', ReviewController::class);
