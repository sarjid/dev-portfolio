<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// Route::get('/', function () {
//     return Inertia::render('Index', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });



Route::controller(HomeController::class)->group(function () {
    Route::get('/',  'index')->name('index.page');
    Route::get('/services',  'service')->name('service.page');
    Route::get('/portfolio',  'portfolio')->name('portfolio.page');
    Route::get('/pricing/{service:slug}',  'pricing')->name('pricing.page');
    Route::get('/contact',  'contact')->name('contact.page');
    Route::post('/contact-form',  'contactStore')->name('contact.store');
    Route::get('/team',  'team')->name('team.page');
    Route::get('/billing/{pricing:slug}',  'billing')->name('billing.page');
    Route::get('/download-cv',  'downloadCv')->name('download.cv');
});



Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});




// require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
