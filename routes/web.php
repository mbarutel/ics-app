<?php

use App\Http\Controllers\EventController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('homepage');
});

// Event Related Controller
Route::get('/create-event', [EventController::class, 'showCreateEventForm']);
Route::post('/create-event', [EventController::class, 'storeNewEvent']);
