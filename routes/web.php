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
    return view('welcome');
});

Route::get('/dashboard', \App\Http\Controllers\Admin\DashboardController::class)->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/languages/import', [\App\Http\Controllers\Admin\LanguageManagementController::class, 'handleImportData'])->name('languages.import');
    Route::delete('/languages/revert', [\App\Http\Controllers\Admin\LanguageManagementController::class, 'revertImportData'])->name('languages.revert');
    Route::resource('/languages', \App\Http\Controllers\Admin\LanguageManagementController::class)->except('show');

    Route::get('/configuration/openai', [\App\Http\Controllers\Admin\AppConfigurationController::class, 'openAiConfigIndex'])->name('config.openai.index');
    Route::post('/configuration/openai', [\App\Http\Controllers\Admin\AppConfigurationController::class, 'openAiConfigStore'])->name('config.openai.store');
});

require __DIR__ . '/auth.php';
