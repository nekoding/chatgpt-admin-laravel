<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/languages', \App\Http\Controllers\API\LanguageController::class)->name('api.languages.index');
Route::get('/cards', \App\Http\Controllers\API\CardController::class)->name('api.cards.index');
Route::get('/configs', \App\Http\Controllers\API\ConfigController::class)->name('api.configs.index');

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});
