<?php

use App\Http\Controllers\Web\AdminViewController;
use App\Http\Controllers\Web\LandingController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LandingController::class, 'index'])->name('landing');
Route::get('/admin/login', [AdminViewController::class, 'login'])->name('login');

Route::middleware('auth')->group(function () {
    Route::get('/admin', [AdminViewController::class, 'dashboard'])->name('admin.dashboard');
});
