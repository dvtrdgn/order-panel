<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DealerController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\UserController;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    if (auth()->check()) {
        return redirect(RouteServiceProvider::HOME);
    }
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',  config('jetstream.auth_session'),  'verified'
])->group(function () {
    // Route::get('/dashboard', function () {
    //     return view('dashboard');
    // })->name('dashboard');
});

Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
Route::get('/admin/users', [UserController::class, 'index'])->name('admin.user.index');
Route::get('/admin/user/create', [UserController::class, 'create'])->name('admin.user.create');
Route::get('/admin/user/edit/{id}', [UserController::class, 'edit'])->name('admin.user.edit');
Route::get('/admin/dealers', [DealerController::class, 'index'])->name('admin.dealer.index');
Route::get('/admin/setting/edit', [SettingController::class, 'edit'])->name('admin.setting.edit');


