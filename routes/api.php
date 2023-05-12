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
    Route::post('/open-ai', [\App\Http\Controllers\API\OpenAiController::class, 'store'])->name('api.opena-ai.store');
    Route::prefix('auth')->group(function () {
        Route::post('/login', [\App\Http\Controllers\API\AuthController::class, 'login'])->name('api.auth.login');
        Route::post('/signup', [\App\Http\Controllers\API\AuthController::class, 'signup'])->name('api.auth.signup');
        Route::post('/logout', [\App\Http\Controllers\API\AuthController::class, 'logout'])->name('api.auth.logout');
        Route::post('/refresh-token', [\App\Http\Controllers\API\AuthController::class, 'refresh'])->name('api.auth.refresh');
    });
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});
