<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SupportController;
use App\Http\Controllers\CartController;

// ── Públicas ──────────────────────────────────────────────────
Route::get('/',         fn() => view('home'))->name('home');
Route::get('/catalogo', fn() => view('catalog'))->name('catalog');
Route::get('/nosotros', fn() => view('us'))->name('us');

Route::get('/soporte',  [SupportController::class, 'index'])->name('support');
Route::post('/soporte', [SupportController::class, 'store'])->name('support.store');

Route::get('/carrito',              [CartController::class, 'index'])->name('cart');
Route::post('/carrito/agregar',     [CartController::class, 'add'])->name('cart.add');
Route::get('/carrito/count',        [CartController::class, 'count'])->name('cart.count');
Route::patch('/carrito/{cartItem}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/carrito/{cartItem}',[CartController::class, 'remove'])->name('cart.remove');
Route::delete('/carrito',           [CartController::class, 'clear'])->name('cart.clear');

// ── Autenticación (solo para invitados) ───────────────────────
Route::middleware('guest')->group(function () {
    Route::get('/login',    [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login',   [AuthController::class, 'login'])->name('login.post');
    Route::get('/registro', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/registro',[AuthController::class, 'register'])->name('register.post');
});

// ── Protegidas con auth ────────────────────────────────────────
Route::middleware('auth')->group(function () {
    Route::get('/mensajes',              [SupportController::class, 'messages'])->name('messages');
    Route::get('/mensajes/{pqrs}/edit',  [SupportController::class, 'edit'])->name('pqrs.edit');
    Route::put('/mensajes/{pqrs}',       [SupportController::class, 'update'])->name('pqrs.update');
    Route::delete('/mensajes/{pqrs}',    [SupportController::class, 'destroy'])->name('pqrs.destroy');
    Route::post('/logout',               [AuthController::class, 'logout'])->name('logout');
});
