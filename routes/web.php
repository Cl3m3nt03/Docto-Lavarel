<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ScheduleController;

Route::middleware(['auth'])->group(function () {
    Route::get('/schedules', [ScheduleController::class, 'index'])
        ->name('schedules.index');

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])
    ->name('home');
