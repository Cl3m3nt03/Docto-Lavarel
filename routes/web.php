<?php

use App\Http\Controllers\Appointment\TakeAppointment;
use App\Http\Controllers\contactController;
use App\Http\Controllers\ScheduleController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\EventController;


Route::middleware(['auth'])->group(function () {
    Route::get('/schedules', [ScheduleController::class, 'index'])
        ->name('schedules.create');

    Route::get('/schedules/create', [ScheduleController::class, 'create'])
        ->name('schedules.create')
        ->middleware('can:create,App\Models\Schedule');

    Route::post('/schedules', [ScheduleController::class, 'store'])
        ->name('schedules.store');
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
Route::get('/debug/appoitment', [TakeAppointment::class, 'index']);
Route::post('/send-mail', [contactController::class, 'sendMail'])->name('send.mail');
Route::get('/receive-mail', [contactController::class, 'index']);
Route::get('/appointment', [TakeAppointment::class, 'view'])->name('appointment');
Route::get('/dashboard', [\App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
Route::get('/events', [EventController::class, 'getAllEventsCalendar']);