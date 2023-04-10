<?php

use App\Http\Controllers\ProfileController;
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
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/languages/import', [\App\Http\Controllers\Admin\LanguageManagementController::class, 'handleImportData'])->name('languages.import');
    Route::delete('/languages/revert', [\App\Http\Controllers\Admin\LanguageManagementController::class, 'revertImportData'])->name('languages.revert');
    Route::resource('/languages', \App\Http\Controllers\Admin\LanguageManagementController::class)->except('show');


    Route::prefix('configuration')->group(function () {
        Route::get('openai', [\App\Http\Controllers\Admin\AppConfigurationController::class, 'openAiConfigIndex'])->name('config.openai.index');
        Route::post('openai', [\App\Http\Controllers\Admin\AppConfigurationController::class, 'openAiConfigStore'])->name('config.openai.store');

        Route::get('prompt', [\App\Http\Controllers\Admin\AppConfigurationController::class, 'openAiPromptIndex'])->name('config.prompt.index');
        Route::post('prompt', [\App\Http\Controllers\Admin\AppConfigurationController::class, 'openAiPromptStore'])->name('config.prompt.store');
    });

    Route::resource('/cards', \App\Http\Controllers\Admin\CardManagementController::class);
});

require __DIR__ . '/auth.php';
