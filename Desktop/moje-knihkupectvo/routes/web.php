<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AccountController;

Route::get('/', [BookController::class, 'index']);
Route::get('/knihy/{id}', [BookController::class, 'show']);

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register']);
Route::get('/logout', [AuthController::class, 'logout']);

Route::get('/kosik', [CartController::class, 'index']);
Route::get('/kosik/pridat/{id}', [CartController::class, 'add']);
Route::get('/kosik/zvysit/{id}', [CartController::class, 'increase']);
Route::get('/kosik/znizit/{id}', [CartController::class, 'decrease']);
Route::get('/kosik/remove/{id}', [CartController::class, 'remove']);

Route::middleware('auth')->group(function () {
    Route::get('/account', [AccountController::class, 'show']);
    Route::put('/account', [AccountController::class, 'update']);
    Route::put('/account/password', [AccountController::class, 'updatePassword']);

    Route::get('/objednavka', [OrderController::class, 'show']);
    Route::post('/objednavka', [OrderController::class, 'store']);
});

Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/', function() {
        if (auth()->user()->email !== 'admin@admin.com') {
            return redirect('/')->with('error', 'Nemáš oprávnenie!');
        }
        return app()->make(BookController::class)->adminIndex();
    });

    Route::get('/knihy/pridat', function() {
        if (auth()->user()->email !== 'admin@admin.com') return redirect('/');
        return app()->make(BookController::class)->create();
    });

    Route::post('/knihy', [BookController::class, 'store']);

    Route::get('/knihy/{id}/upravit', function($id) {
        if (auth()->user()->email !== 'admin@admin.com') return redirect('/');
        return app()->make(BookController::class)->edit($id);
    });

    Route::put('/knihy/{id}', [BookController::class, 'update']);
    Route::delete('/knihy/{id}', [BookController::class, 'destroy']);
});