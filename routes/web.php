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
])->prefix('admin')->name('admin.')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/users', [UserController::class, 'index'])->name('user.index');
    Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
    Route::get('/user/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
    Route::get('/dealers', [DealerController::class, 'index'])->name('dealer.index');
    Route::get('/dealer/create', [DealerController::class, 'create'])->name('dealer.create');
    Route::get('/dealer/edit/{id}', [DealerController::class, 'edit'])->name('dealer.edit');
    Route::get('/dealer/order-list/{id}', [DealerController::class, 'dealerOrderList'])->name('dealer.order-list');
    Route::get('/setting/edit', [SettingController::class, 'edit'])->name('setting.edit');
    Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
    Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create');
    Route::get('/category/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
    Route::get('/product', [ProductController::class, 'index'])->name('product.index');
    Route::get('/product/create', [ProductController::class, 'create'])->name('product.create');
    Route::get('/product/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
    Route::get('/waiting-order', [OrderController::class, 'waitingOrder'])->name('order.waiting');
    Route::get('/completed-order', [OrderController::class, 'completedOrder'])->name('order.completed');
});
