<?php

use App\Http\Controllers\AlHassanController; 
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::controller(AlHassanController::class)->group(function() {
    // Index route
    Route::get('/al-hassan', 'index')->name('al_hassan.index');

    // Create route
    Route::get('/al-hassan/create', 'create')->name('al_hassan.create');

    // Edit route
    Route::get('/al-hassan/{id}/edit', 'edit')->name('al_hassan.edit');

    // Update route
    Route::put('/al-hassan/{id}', 'update')->name('al_hassan.update');

    // Store route
    Route::post('/al-hassan', 'store')->name('al_hassan.store');

    // Delete route
    Route::delete('/al-hassan/{id}', 'destroy')->name('al_hassan.destroy');
});

