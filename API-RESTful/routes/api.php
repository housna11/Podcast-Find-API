<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\PodcastController;
use App\Http\Controllers\EpisodeController;
use App\Http\Controllers\UserController;



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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::post('/register',[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/resetPassword',[AuthController::class, 'resetPassword']);
    Route::get('/podcasts', [PodcastController::class, 'index']);
    Route::get('/podcasts/{id}', [PodcastController::class, 'show']);
    Route::post('/podcasts', [PodcastController::class, 'store']);
    Route::post('/podcasts/{podcast}', [PodcastController::class, 'update']);
    Route::delete('/podcasts/{podcast}', [PodcastController::class, 'destroy']);
    Route::get('/podcasts/{podcast_id}/episodes', [EpisodeController::class, 'index']);
    Route::get('/episodes/{id}', [EpisodeController::class, 'show']);
    Route::post('/podcasts/{podcast_id}/episodes', [EpisodeController::class, 'store']);
    Route::post('/episodes/{episode}', [EpisodeController::class, 'update']);
    Route::delete('/episodes/{episode}', [EpisodeController::class, 'destroy']);
    Route::get('/users', [UserController::class, 'index']);
    Route::post('/users', [UserController::class, 'store']);
    Route::put('/users/{id}', [UserController::class, 'update']);
    Route::delete('/users/{id}', [UserController::class, 'destroy']);
    Route::get('/hosts', [UserController::class, 'indexHosts']);
    Route::get('/hosts/{id}', [UserController::class, 'showHost']);


});