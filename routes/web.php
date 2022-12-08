<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DealerController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
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
])->prefix('admin')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/users', [UserController::class, 'index'])->name('admin.user.index');
    Route::get('/user/create', [UserController::class, 'create'])->name('admin.user.create');
    Route::get('/user/edit/{id}', [UserController::class, 'edit'])->name('admin.user.edit');
    Route::get('/dealers', [DealerController::class, 'index'])->name('admin.dealer.index');
    Route::get('/dealer/create', [DealerController::class, 'create'])->name('admin.dealer.create');
    Route::get('/dealer/edit/{id}', [DealerController::class, 'edit'])->name('admin.dealer.edit');
    Route::get('/setting/edit', [SettingController::class, 'edit'])->name('admin.setting.edit');
    Route::get('/category', [CategoryController::class, 'index'])->name('admin.category.index');
    Route::get('/category/create', [CategoryController::class, 'create'])->name('admin.category.create');
    Route::get('/category/edit/{id}', [CategoryController::class, 'edit'])->name('admin.category.edit');
    Route::get('/product', [ProductController::class, 'index'])->name('admin.product.index');
    Route::get('/product/create', [ProductController::class, 'create'])->name('admin.product.create');
    Route::get('/product/edit/{id}', [ProductController::class, 'edit'])->name('admin.product.edit');
    Route::get('/waiting-order', [OrderController::class, 'waitingOrder'])->name('admin.order.waiting');
    Route::get('/completed-order', [OrderController::class, 'completedOrder'])->name('admin.order.completed');
});
