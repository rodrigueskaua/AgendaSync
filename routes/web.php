<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\UserController;
use App\Http\Controllers\ContactBookController;

Route::get('/', [ContactBookController::class, 'index'])->name('home');

Route::get('/contact/create ', function () {
  return Inertia::render('ContactCreate');
})->name('contact.register');

Route::post('/contact/create',[ContactBookController::class, 'create'])
->name('contact.create');

Route::put('/contact/update/{id}', [ContactBookController::class, 'update'])->name('contact.update');

Route::get('/contact/update/{id}', [ContactBookController::class, 'edit'])->name('contact.edit');

Route::get('/contact/{id}', [ContactBookController::class, 'show'])->name('contact.show');

Route::get('/login', function () {
  return Inertia::render('Login');
})->name('login');

Route::get('/register', function () {
  return Inertia::render('Register');
})->name('register');

Route::post('/user/create',[UserController::class, 'create'])
->name('user.create');

Route::post('login',[UserController::class, 'login'])
->name('user.login');

Route::get('/logout', [UserController::class, 'logout'])->name('user.logout');