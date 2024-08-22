<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\UserController;

Route::get('/', function () {
    return Inertia::render('Test');
});

Route::get('/login', function () {
  return Inertia::render('Login');
})->name('login');

Route::get('/register', function () {
  return Inertia::render('Register');
})->name('register');

Route::post('/user/create',[UserController::class, 'create'])
->name('user.create');