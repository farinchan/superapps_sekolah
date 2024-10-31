<?php

use App\Http\Controllers\Api\UtilityController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/get-calendar', [UtilityController::class, 'getCalendar'])->name('get-calendar');
Route::get('/get-classroom', [UtilityController::class, 'getClassroom'])->name('api.get-classroom');
