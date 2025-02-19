<?php

use App\Http\Controllers\ScheduleController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppointmentController;

use App\Http\Controllers\ScheduleController;

Route::middleware(['auth'])->group(function () {
    Route::resource('schedules', ScheduleController::class);
});


Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/calendar', [AppointmentController::class, 'calendar'])->name('calendar');
Route::get('/schedule', [ScheduleController::class, 'schedules'])->name('calendar');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/home', [App\Http\Controllers\HomeController::class, 'store'])->name('home');
Route::get('/home/show' ,[App\Http\Controllers\ScheduleController::class, 'show'] )->name('home');
Route::get('/get-schedule-hours', [ScheduleController::class, 'show']);

