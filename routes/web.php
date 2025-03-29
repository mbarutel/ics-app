<?php

use App\Http\Controllers\ConferenceController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventController;
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
Route::post('/logout', [UserController::class, 'logout'])->middleware('mustBeLoggedIn');

// Dashboard related controllers
Route::get('/dashboard', [DashboardController::class, 'showDashboard'])->middleware('mustBeLoggedIn');

// Event related controllers
Route::get('/events', [EventController::class, 'showEvents'])->middleware('mustBeLoggedIn');
Route::get('/create-event', [EventController::class, 'showCreateEventForm'])->middleware('mustBeLoggedIn');
Route::get('/event/{event}/edit', [EventController::class, 'showEditEventForm'])->middleware('mustBeLoggedIn');
Route::post('/event', [EventController::class, 'storeNewEvent'])->middleware('mustBeLoggedIn');
Route::post('/event/{event}/publish', [EventController::class, 'publishEvent'])->middleware('mustBeLoggedIn');
Route::put('/event/{event}', [EventController::class, 'updateEvent'])->middleware('mustBeLoggedIn');

// Conference related controllers
/* Route::get('/events', [EventController::class, 'showEvents'])->middleware('mustBeLoggedIn'); */
Route::get('/create-conference', [ConferenceController::class, 'showCreateConferenceForm'])->middleware('mustBeLoggedIn');
/* Route::get('/event/{event}/edit', [EventController::class, 'showEditEventForm'])->middleware('mustBeLoggedIn'); */
/* Route::post('/event', [EventController::class, 'storeNewEvent'])->middleware('mustBeLoggedIn'); */
/* Route::post('/event/{event}/publish', [EventController::class, 'publishEvent'])->middleware('mustBeLoggedIn'); */
/* Route::put('/event/{event}', [EventController::class, 'updateEvent'])->middleware('mustBeLoggedIn'); */
