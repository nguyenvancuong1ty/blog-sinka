<?php

use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ImageController;
use App\Http\Controllers\Api\PostController;
use App\Http\Middleware\JwtMiddleware;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    $data =  User::all();
    return response()->json($data, 200);
});

Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me'])->middleware(JwtMiddleware::class);
});

Route::middleware([JwtMiddleware::class])->prefix('category')->group(function () {
    Route::get('/', [CategoryController::class, 'paginate']);
    Route::get('/{id}', [CategoryController::class, 'edit']);
    Route::post('/create-or-update', [CategoryController::class, 'createOrUpdate']);
    Route::delete('/delete/{id}', [CategoryController::class, 'delete']);
});

Route::group([
    'prefix' => 'post'
], function () {
    Route::get('/', [PostController::class, 'paginate']);
    Route::get('/{id}', [PostController::class, 'edit']);
    Route::post('/create-or-update', [PostController::class, 'createOrUpdate']);
    Route::delete('/delete/{id}', [PostController::class, 'delete']);
});

Route::group([
    'prefix' => 'image'
], function () {
    Route::get('/', [ImageController::class, 'paginate']);
    Route::get('/{id}', [ImageController::class, 'edit']);
    Route::post('/create-or-update', [ImageController::class, 'createOrUpdate']);
    Route::delete('/delete/{id}', [ImageController::class, 'delete']);
});