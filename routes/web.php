<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('/dashboard', \App\Http\Controllers\Admin\DashboardController::class)->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [\App\Http\Controllers\Admin\ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [\App\Http\Controllers\Admin\ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [\App\Http\Controllers\Admin\ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/languages/import', [\App\Http\Controllers\Admin\LanguageManagementController::class, 'handleImportData'])->name('languages.import');
    Route::delete('/languages/revert', [\App\Http\Controllers\Admin\LanguageManagementController::class, 'revertImportData'])->name('languages.revert');
    Route::resource('/languages', \App\Http\Controllers\Admin\LanguageManagementController::class)->except('show');

    Route::resource('/tarot-spreads', \App\Http\Controllers\Admin\TarotSpreadCategoryManagementController::class)
        ->except(['show']);
    Route::resource('/reading-categories', \App\Http\Controllers\Admin\TarotReadingCategoryManagementController::class)
        ->except(['show']);
    Route::resource('/prompts', \App\Http\Controllers\Admin\PromptManagementController::class);


    Route::prefix('configuration')->group(function () {
        Route::get('openai', [\App\Http\Controllers\Admin\AppConfigurationController::class, 'openAiConfigIndex'])->name('config.openai.index');
        Route::post('openai', [\App\Http\Controllers\Admin\AppConfigurationController::class, 'openAiConfigStore'])->name('config.openai.store');

        Route::get('prompt', [\App\Http\Controllers\Admin\AppConfigurationController::class, 'openAiPromptIndex'])->name('config.prompt.index');
        Route::post('prompt', [\App\Http\Controllers\Admin\AppConfigurationController::class, 'openAiPromptStore'])->name('config.prompt.store');
    });

    Route::resource('/cards', \App\Http\Controllers\Admin\CardManagementController::class);
});

require __DIR__ . '/auth.php';
