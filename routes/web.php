<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\UserController;
use App\Http\Controllers\ContactBookController;

Route::middleware(['auth'])->group(function () {
  Route::get('/', [ContactBookController::class, 'index'])->name('home');

  Route::get('/contact/create', function () {
      return Inertia::render('ContactCreate');
  })->name('contact.register');

  Route::post('/contact/create', [ContactBookController::class, 'create'])->name('contact.create');
  Route::put('/contact/update/{id}', [ContactBookController::class, 'update'])->name('contact.update');
  Route::get('/contact/update/{id}', [ContactBookController::class, 'edit'])->name('contact.edit');
  Route::delete('/contact/destroy/{id}', [ContactBookController::class, 'destroy'])->name('contact.destroy');
  Route::get('/contact/{id}', [ContactBookController::class, 'show'])->name('contact.show');
  
  Route::get('/profile', [UserController::class, 'index'])->name('user.index');
  
  Route::put('/user/update/', [UserController::class, 'update'])->name('user.update');
  Route::get('/user/update/', [UserController::class, 'edit'])->name('user.edit');
  Route::delete('/user/destroy/', [UserController::class, 'destroy'])->name('user.destroy');

  Route::get('/logout', [UserController::class, 'logout'])->name('user.logout');
});

Route::middleware(['guest'])->group(function () {
  Route::get('/login', function () {
      return Inertia::render('Login');
  })->name('login');

  Route::get('/register', function () {
      return Inertia::render('Register');
  })->name('register');
  
  Route::get('/login/google', [UserController::class, 'redirectGoogle'])->name('login.google');
  Route::get('/login/google/call-back', [UserController::class, 'callbackGoogle']);
  
  Route::post('/user/create', [UserController::class, 'create'])->name('user.create');
  Route::post('login', [UserController::class, 'login'])->name('user.login');
});