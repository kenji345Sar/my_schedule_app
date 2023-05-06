<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\ScheduleItemController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [ScheduleController::class, 'index'])->name('dashboard');
    Route::get('/schedules', [ScheduleController::class, 'index'])->name('schedules.index');
    Route::get('/schedules/create', [ScheduleController::class, 'create'])->name('schedules.create');
    Route::post('/schedules', [ScheduleController::class, 'store'])->name('schedules.store');
    Route::get('/schedules/{schedule}', [ScheduleController::class, 'show'])->name('schedules.show');
    Route::get('/schedules/{schedule}/edit', [ScheduleController::class, 'edit'])->name('schedules.edit');
    Route::put('/schedules/{schedule}', [ScheduleController::class, 'update'])->name('schedules.update');
    Route::delete('/schedules/{schedule}', [ScheduleController::class, 'destroy'])->name('schedules.destroy');

    // ScheduleItem routes
    Route::get('/schedules/{schedule}/schedule_items/create', [ScheduleItemController::class, 'create'])->name('schedules.schedule_items.create');
    Route::post('/schedules/{schedule}/schedule_items', [ScheduleItemController::class, 'store'])->name('schedules.schedule_items.store');
    Route::get('/schedule_items/{schedule_item}/edit', [ScheduleItemController::class, 'edit'])->name('schedule_items.edit');
    Route::put('/schedule_items/{schedule_item}', [ScheduleItemController::class, 'update'])->name('schedule_items.update');
    Route::delete('/schedule_items/{schedule_item}', [ScheduleItemController::class, 'destroy'])->name('schedule_items.destroy');
});

Route::post('/schedules/{schedule}/add_user', [ScheduleController::class, 'addUser'])->name('schedules.addUser');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
