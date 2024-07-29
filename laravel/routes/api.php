<?php

use App\Http\Controllers\Api\CategoryController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    $data =  User::all();
    return response()->json($data, 200);
});

Route::group([
    'prefix' => 'category'
], function () {
    Route::get('/', [CategoryController::class, 'index']);
    Route::get('/{id}', [CategoryController::class, 'edit']);
    Route::post('/create-or-update', [CategoryController::class, 'createOrUpdate']);
    Route::delete('/delete/{id}', [CategoryController::class, 'delete']);
});