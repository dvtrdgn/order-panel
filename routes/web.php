<?php

use App\Http\Controllers\Admin\DealerController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',  config('jetstream.auth_session'),  'verified'
])->group(function () {
    // Route::get('/dashboard', function () {
    //     return view('dashboard');
    // })->name('dashboard');
});

Route::get('/admin/users', [UserController::class, 'index'])->name('admin.user.index');
Route::get('/admin/dealers', [DealerController::class, 'index'])->name('admin.dealer.index');
Route::get('/admin/setting/edit', [SettingController::class, 'edit'])->name('admin.setting.edit');


// delete before deploy
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
