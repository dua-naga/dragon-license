<?php

use Illuminate\Support\Facades\Route;
use DuaNaga\DragonLicense\Controllers\DatabaseController;
use DuaNaga\DragonLicense\Controllers\EnvironmentController;
use DuaNaga\DragonLicense\Controllers\FinalController;
use DuaNaga\DragonLicense\Controllers\LicenseController;
use DuaNaga\DragonLicense\Controllers\LicenseItemController;
use DuaNaga\DragonLicense\Controllers\PermissionsController;
use DuaNaga\DragonLicense\Controllers\RequirementsController;
use DuaNaga\DragonLicense\Controllers\WelcomeController;

// Offline mode route
Route::get("offline-mode", [WelcomeController::class, 'offlineMode'])->name('dragon-license.offline');

// License key routes (for existing installations that need license)
Route::group(['prefix' => 'license-key', 'middleware' => ['web', 'is_license']], function () {
    Route::get('/', [LicenseItemController::class, 'welcome'])->name('dragon-license.update');
    Route::get('/insert-key', [LicenseItemController::class, 'validation'])->name('dragon-license.validation');
    Route::post('/store-license', [LicenseItemController::class, 'checkValidation'])->name('dragon-license.store');
});

// App license management routes
Route::prefix('app-license')->middleware(['web'])->group(function () {
    Route::get('update', [LicenseItemController::class, 'updateLicense'])->name('dragon-license.license-update');
    Route::post('store-update', [LicenseItemController::class, 'update']);
});

// Installation wizard routes
Route::group(['prefix' => 'install', 'as' => 'DragonLicense::', 'middleware' => ['web', 'install']], function () {

    Route::get('/', [WelcomeController::class, 'welcome'])->name('welcome');

    Route::prefix('license')->group(function () {
        Route::get('/', [LicenseController::class, 'index'])->name('license');
        Route::post('store', [LicenseController::class, 'savingCredencial'])->name('licenseStore');
    });

    Route::middleware('nextinstall')->group(function () {
        Route::get('/permission', [PermissionsController::class, 'permissions'])->name('permissions');
        Route::get('requirements', [RequirementsController::class, 'requirements'])->name('requirements');
        Route::prefix('environment')->group(function () {
            Route::get('/', [EnvironmentController::class, 'environmentMenu'])->name('environment');
            Route::get('/wizard', [EnvironmentController::class, 'environmentWizard'])->name('environmentWizard');
            Route::post('/saveWizard', [EnvironmentController::class, 'saveWizard'])->name('environmentSaveWizard');
        });
    });

    Route::get('database', [DatabaseController::class, 'database'])->name('database');
    Route::get('final', [FinalController::class, 'finish'])->name('final');
});
