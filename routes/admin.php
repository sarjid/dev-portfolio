<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\ClientReviewController;
use App\Http\Controllers\Admin\HeroController;
use App\Http\Controllers\Admin\PortfolioController;
use App\Http\Controllers\Admin\PricingController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\TeamController;

Route::prefix('admin')->name('admin.')->group(function () {

    /**
     * guest routes.
     */
    Route::controller(AdminAuthController::class)->middleware('admin_guest')->group(function () {
        Route::get('/login', 'showLoginForm')->name('login.view');
        Route::post('/login', 'login')->name('login');
    });

    /**
     * authenticate routes.
     */
    Route::middleware('admin')->group(function () {

        Route::controller(AdminAuthController::class)->group(function () {
            Route::get('/dashboard', 'dashboard')->name('dashboard');
            Route::post('/logout', 'destroy')->name('logout');
        });

        Route::controller(SettingController::class)->group(function () {
            Route::get('system-settings', 'index')->name('system.settings');
            Route::post('system-update', 'update')->name('system.update');
            Route::post('system-file-update', 'fileUpdate')->name('system.file.update');
        });


        Route::controller(HeroController::class)->group(function () {
            Route::get('hero', 'index')->name('hero.index');
            Route::post('hero-update', 'update')->name('hero.update');
        });

        // project Routes will be go here
        Route::resources([
            'service' => ServiceController::class,
            'pricing' => PricingController::class,
            'team' => TeamController::class,
            'review' => ClientReviewController::class,
            'portfolio' => PortfolioController::class,
        ]);


        Route::controller(ClientReviewController::class)->group(function () {
            Route::post('/review/{review}', 'update')->name('review.update');
            Route::delete('review-bulk-delete',  'multipleDelete')->name('review.multiple.destroy');
        });

        Route::delete(
            'service-bulk-delete',
            [ServiceController::class, 'multipleDelete']
        )->name('service.multiple.destroy');
        Route::delete(
            'portfolio-bulk-delete',
            [PortfolioController::class, 'multipleDelete']
        )->name('portfolio.multiple.destroy');

        Route::delete('pricing-bulk-delete', [ServiceController::class, 'multipleDelete'])->name('pricing.multiple.destroy');
    });
});


// Route::get('/admin/login', function () {
//     return PHP_VERSION;
//     //     'canRegister' => Route::has('register'),
//     //     'laravelVersion' => Application::VERSION,
//     //     'phpVersion' => PHP_VERSION,
//     // ]);
// });