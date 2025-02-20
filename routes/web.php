<?php

use App\Http\Controllers\ScheduleController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\EventController;


Route::middleware(['auth'])->group(function () {
    Route::resource('schedules', ScheduleController::class);
});


Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('login');
})->name('login');


Route::get('/events', [EventController::class, 'getAllEvents'])->name('calendar');



Route::get('/calendar', [AppointmentController::class, 'calendar'])->name('calendar');
Route::get('/schedule', [ScheduleController::class, 'schedules'])->name('calendar');
Route::delete('/appointment/{id}', [AppointmentController::class, 'destroy'])->name('appointment.destroy');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/home', [App\Http\Controllers\HomeController::class, 'store'])->name('home');
Route::get('/home/show' ,[App\Http\Controllers\ScheduleController::class, 'show'] )->name('home');
Route::get('/get-schedule-hours', [ScheduleController::class, 'show']);
Route::get('/events', [EventController::class, 'getAllEventsCalendar']);

/*
 * /EVENTS
 * Route::get('/events/{id}', [EventController::class, 'getEvent'])->name('event');
 * Route::get('/events/create', [EventController::class, 'createEvent'])->name('createEvent');
 * Route::post('/events', [EventController::class, 'storeEvent'])->name('storeEvent');
 * Route::get('/events/{id}/edit', [EventController::class, 'editEvent'])->name('editEvent');
 * Route::put('/events/{id}', [EventController::class, 'updateEvent'])->name('updateEvent');
 * Route::delete('/events/{id}', [EventController::class, 'destroyEvent'])->name('destroyEvent');
 * Route::get('/appointments', [AppointmentController::class, 'getAllAppointments'])->name('calendar');
 */
