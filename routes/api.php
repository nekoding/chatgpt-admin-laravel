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

Route::prefix('/v1')->group(function () {
    Route::get('/languages', \App\Http\Controllers\API\LanguageController::class)->name('api.languages.index');
    Route::get('/cards', \App\Http\Controllers\API\CardController::class)->name('api.cards.index');
    Route::get('/configs', \App\Http\Controllers\API\ConfigController::class)->name('api.configs.index');
    Route::get('/tarot-spreads', \App\Http\Controllers\API\TarotSpreadController::class)->name('api.tarot-spreads.index');
    Route::get('/reading-categories', \App\Http\Controllers\API\ReadingCategoryController::class)->name('api.reading-categories.index');
    Route::get('/prompts', \App\Http\Controllers\API\PromptController::class)->name('api.prompts.index');
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});
