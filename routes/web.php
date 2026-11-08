<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');
Route::get('/profile', [PageController::class, 'profile'])->name('profile');
Route::get('/about', [PageController::class, 'about'])->name('about');

Route::resource('customers', CustomerController::class)->except(['show', 'destroy']);
Route::resource('users', UserController::class)->except(['show', 'destroy']);
