<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\RandomController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('homepage');
// });
Route::get('/', function () {
    return auth()->check() ? redirect('/dashboard') : redirect('/login');
});

// User related controllers
Route::get('/login', [UserController::class, 'showLoginForm'])->middleware('guest');
Route::get('/register', [UserController::class, 'showRegistrationForm'])->middleware('guest');
Route::post('/login', [UserController::class, 'login'])->middleware('guest');
Route::post('/register', [UserController::class, 'register'])->middleware('guest');
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');

// Dashboard related controllers
Route::get('/dashboard', [DashboardController::class, 'showDashboard'])->middleware('auth');
// Route::get('/dashboard', function () {
//     return view('dashboard');
// });

// Event related controllers
Route::get('/events', [EventController::class, 'showEvents'])->middleware('auth');
Route::get('/create-event', [EventController::class, 'showCreateEventForm'])->middleware('auth');
Route::get('/event/{event}/edit', [EventController::class, 'showEditEventForm'])->middleware('auth');

Route::post('/event', [EventController::class, 'storeNewEvent'])->middleware('auth');
// Route::put('/event/{id}', [EventController::class, 'updateEvent'])->middleware('auth');
