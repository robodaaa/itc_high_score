<?php

use App\Http\Controllers\GameController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'index')->name('home');
Route::controller(GameController::class)->group(function () {
    Route::get('/game/{slug}', 'game')->name('game');
});