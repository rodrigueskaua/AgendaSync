<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\UserController;
use App\Http\Controllers\ContactBookController;

Route::get('/', [ContactBookController::class, 'index'])->name('home');
Route::get('/contact/{id}', [ContactBookController::class, 'show'])->name('show');

Route::get('/login', function () {
  return Inertia::render('Login');
})->name('login');

Route::get('/register', function () {
  return Inertia::render('Register');
})->name('register');

Route::post('/user/create',[UserController::class, 'create'])
->name('user.create');