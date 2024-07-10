<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\CheckUserSession;
use App\Http\Middleware\CheckAdminRole;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'doLogin'])->name('do-login');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware([CheckUserSession::class])->group(function () {
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');

    Route::middleware([CheckAdminRole::class])->group(function () {
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::get('/users/create', [UserController::class, 'show'])->name('users.show');
        Route::get('/users/edit/{id}', [UserController::class, 'edit'])->name('users.edit');
        Route::post('/users/createUser', [UserController::class, 'store'])->name('users.store');
        Route::post('/users/update/{id}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/users/destroy/{id}', [UserController::class, 'destroy'])->name('users.destroy');
        
        Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
        Route::get('/products/edit/{id}', [ProductController::class, 'edit'])->name('products.edit');
        Route::post('/products/store', [ProductController::class, 'store'])->name('products.store');
        Route::put('/products/update/{id}', [ProductController::class, 'update'])->name('products.update');
        Route::post('/products/destroy/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
    });
    
});
