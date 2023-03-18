<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\UserController as APIUserController;
use App\Http\Controllers\Api\ProductController as APIProductController;
use App\Http\Controllers\Api\AuthController as APIAuthController;

Route::post('login', [APIAuthController::class, 'signin']);
Route::post('register', [APIAuthController::class, 'signup']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware(['auth:sanctum', 'admin'])->group(function () {
    Route::post('/addUser', [APIUserController::class, 'addUser']);
    Route::get('/getUsers', [APIUserController::class, 'getUsers']);
    Route::post('/deleteUser', [APIUserController::class, 'deleteUser']);
    Route::post('/editUser', [APIUserController::class, 'updateUser']);
    Route::post('/assignProducts', [APIUserController::class, 'assignProducts']);
    Route::post('/addProduct', [APIProductController::class, 'addProduct']);
    Route::post('/updateProducts', [APIProductController::class, 'updateProducts']);
    Route::get('/getProducts', [APIProductController::class, 'getProducts']);
    Route::post('/deleteProduct', [APIProductController::class, 'deleteProduct']);
});
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/getUserProducts', [APIUserController::class, 'getUserProducts']);
});
