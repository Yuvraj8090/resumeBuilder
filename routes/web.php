<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ResumeController;
use App\Http\Controllers\AiController;
use App\Http\Controllers\Admin\TemplateController;

Route::post('/ai/rewrite', [AiController::class, 'rewrite'])->name('ai.rewrite');

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    

Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('templates', TemplateController::class);
});
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Users
    Route::get('users/data', [UserController::class, 'data'])->name('users.data');
    Route::resource('users', UserController::class);

    // Roles
    Route::get('resumes/{id}/template', [ResumeController::class, 'selectTemplate'])->name('resumes.selectTemplate');
    Route::post('resumes/{id}/template', [ResumeController::class, 'updateTemplate'])->name('resumes.updateTemplate');
    Route::get('resumes/{id}/preview', [ResumeController::class, 'preview'])->name('resumes.preview');
    Route::get('roles/data', [RoleController::class, 'data'])->name('roles.data');
    Route::resource('roles', RoleController::class);
    Route::get('resumes/data', [ResumeController::class, 'data'])->name('resumes.data');
    Route::resource('resumes', ResumeController::class);

});