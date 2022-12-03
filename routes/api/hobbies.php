<?php

use App\Http\Controllers\API\HobbyController;
use Illuminate\Support\Facades\Route;

Route::get('/users/{id}/hobbies', [HobbyController::class, 'getByUser'])->name('getByUser');
Route::get('/hobbies/{id}', [HobbyController::class, 'find'])->name('findHobby');
Route::put('/hobbies/{id}', [HobbyController::class, 'edit'])->name('editHobby');
Route::delete('/hobbies/{id}', [HobbyController::class, 'delete'])->name('deleteHobby');
Route::get('/hobbies', [HobbyController::class, 'get'])->name('getHobbies');
