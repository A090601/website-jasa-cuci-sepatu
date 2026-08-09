<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\PriceController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\Frontend\TestimonialController as FrontendTestimonialController;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\BookingController as AdminBookingController;
use App\Http\Controllers\Admin\GalleryController as AdminGalleryController;

/*
|--------------------------------------------------------------------------
| Frontend
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/booking', [BookingController::class, 'create'])
    ->name('booking.create');

Route::post('/booking', [BookingController::class, 'store'])
    ->name('booking.store');

Route::get('/booking/success/{booking}', [BookingController::class, 'success'])
    ->name('booking.success');

Route::get('/cek-status', [BookingController::class, 'statusForm'])
    ->name('booking.status');

Route::post('/cek-status', [BookingController::class, 'checkStatus'])
    ->name('booking.checkStatus');

Route::get('/testimonial/{booking}', [FrontendTestimonialController::class, 'create'])
    ->name('testimonial.create');

Route::post('/testimonial', [FrontendTestimonialController::class, 'store'])
    ->name('testimonial.store');


/*
|--------------------------------------------------------------------------
| Admin
|--------------------------------------------------------------------------
*/

Route::middleware('auth')
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');

        Route::get('bookings/export/pdf', [AdminBookingController::class, 'exportPdf'])
            ->name('bookings.pdf');

        Route::get(
            'bookings/export/excel',
            [AdminBookingController::class, 'exportExcel']
        )->name('bookings.excel');

        Route::resource('bookings', AdminBookingController::class);

        Route::resource('services', ServiceController::class);
        Route::resource('prices', PriceController::class);
        Route::resource('galleries', AdminGalleryController::class);
        Route::resource('testimonials', TestimonialController::class)
            ->only(['index', 'destroy']);
        Route::patch(
            'testimonials/{testimonial}/toggle',
            [TestimonialController::class, 'toggleStatus']
        )->name('testimonials.toggle');
        Route::resource('settings', SettingController::class)
            ->only(['index', 'update']);
    });

/*
|--------------------------------------------------------------------------
| Profile
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

require __DIR__ . '/auth.php';
