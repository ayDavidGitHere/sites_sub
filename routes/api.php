<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\WebsiteController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SubscriptionController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('users')->group(function () {
    Route::get('/get', [UserController::class, 'index']); 
    Route::post('/create', [UserController::class, 'store']);  
    Route::get('/get/{email}', [UserController::class, 'show']);  
});

Route::prefix('websites')->group(function () {
    // CRUD website
    Route::get('/', [WebsiteController::class, 'index']);
    Route::post('/create', [WebsiteController::class, 'store']);
    // Create Website Post
    Route::post('/{website}/posts/create', [PostController::class, 'store']);
    // Create Website Subscription
    Route::post('/{website}/subscribe', [SubscriptionController::class, 'store']);
});
