<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\AuthorController;

Route::get('/', [BookController::class, 'index']);
Route::get('/knihy/{id}', [BookController::class, 'show']);

Route::get('/autor/{slug}', [AuthorController::class, 'show']);

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

// Objednávka - dostupná aj bez prihlásenia
Route::get('/objednavka', [OrderController::class, 'show']);
Route::post('/objednavka', [OrderController::class, 'store']);

Route::middleware('auth')->group(function () {
    Route::get('/account', [AccountController::class, 'show']);
    Route::put('/account', [AccountController::class, 'update']);
    Route::put('/account/password', [AccountController::class, 'updatePassword']);
    Route::post('/account/avatar', [AccountController::class, 'updateAvatar']);
    Route::delete('/account/avatar', [AccountController::class, 'removeAvatar']);
});

// ADMIN ROUTES 
Route::middleware(['auth'])->prefix('admin')->group(function () {
    
    $adminCheck = function() {
        if (auth()->user()->email !== 'admin@admin.com') {
            return redirect('/')->with('error', 'Nemáš oprávnenie!');
        }
        return null;
    };

    // KNIHY 
    Route::get('/', function() use ($adminCheck) {
        $redirect = $adminCheck();
        if ($redirect) return $redirect;
        return app()->make(BookController::class)->adminIndex();
    })->name('admin.knihy.index');

    Route::get('/knihy/pridat', function() use ($adminCheck) {
        $redirect = $adminCheck();
        if ($redirect) return $redirect;
        return app()->make(BookController::class)->create();
    })->name('admin.knihy.create');

    Route::post('/knihy', function(\Illuminate\Http\Request $request) use ($adminCheck) {
        $redirect = $adminCheck();
        if ($redirect) return $redirect;
        return app()->make(BookController::class)->store($request);
    })->name('admin.knihy.store');

    Route::get('/knihy/{id}/upravit', function($id) use ($adminCheck) {
        $redirect = $adminCheck();
        if ($redirect) return $redirect;
        return app()->make(BookController::class)->edit($id);
    })->name('admin.knihy.edit');

    Route::put('/knihy/{id}', function(\Illuminate\Http\Request $request, $id) use ($adminCheck) {
        $redirect = $adminCheck();
        if ($redirect) return $redirect;
        return app()->make(BookController::class)->update($request, $id);
    })->name('admin.knihy.update');

    Route::delete('/knihy/{id}', function($id) use ($adminCheck) {
        $redirect = $adminCheck();
        if ($redirect) return $redirect;
        return app()->make(BookController::class)->destroy($id);
    })->name('admin.knihy.destroy');

    // AUTORI 
    Route::get('/autori', function() use ($adminCheck) {
        $redirect = $adminCheck();
        if ($redirect) return $redirect;
        return app()->make(AuthorController::class)->adminIndex();
    })->name('admin.autori.index');

    Route::get('/autori/pridat', function() use ($adminCheck) {
        $redirect = $adminCheck();
        if ($redirect) return $redirect;
        return app()->make(AuthorController::class)->create();
    })->name('admin.autori.create');

    Route::post('/autori', function(\Illuminate\Http\Request $request) use ($adminCheck) {
        $redirect = $adminCheck();
        if ($redirect) return $redirect;
        return app()->make(AuthorController::class)->store($request);
    })->name('admin.autori.store');

    Route::get('/autori/{id}/upravit', function($id) use ($adminCheck) {
        $redirect = $adminCheck();
        if ($redirect) return $redirect;
        return app()->make(AuthorController::class)->edit($id);
    })->name('admin.autori.edit');

    Route::put('/autori/{id}', function(\Illuminate\Http\Request $request, $id) use ($adminCheck) {
        $redirect = $adminCheck();
        if ($redirect) return $redirect;
        return app()->make(AuthorController::class)->update($request, $id);
    })->name('admin.autori.update');

    Route::delete('/autori/{id}', function($id) use ($adminCheck) {
        $redirect = $adminCheck();
        if ($redirect) return $redirect;
        return app()->make(AuthorController::class)->destroy($id);
    })->name('admin.autori.destroy');
});