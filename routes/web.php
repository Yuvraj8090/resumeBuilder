<?php

use Illuminate\Support\Facades\Route;
 use App\Http\Controllers\RoleController;
 use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
   
Route::get('users/data', [UserController::class, 'data'])->name('users.data');
Route::resource('users', UserController::class);
    Route::get('roles/data', [RoleController::class, 'data'])->name('roles.data');
    Route::resource('roles', RoleController::class);

});
