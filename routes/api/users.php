<?php

use App\Http\Controllers\API\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/users/{id}', [UserController::class, 'get'])->name('get');
Route::put('/users/{id}', [UserController::class, 'update'])->name('update');
Route::delete('/users/{id}', [UserController::class, 'delete'])->name('delete');
Route::get('/users', [UserController::class, 'getAll'])->name('getAll');
