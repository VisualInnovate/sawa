<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::middleware(['auth:parent', 'phone_verified'])->group(function () {
    Route::group(['prefix' => 'calender'], function () {
        Route::get('/events', [\Modules\Calender\Http\Controllers\CalenderController::class, 'groupedEventsForParents'])->name('calender.events_parents');
        Route::get('/appointments', [\Modules\Calender\Http\Controllers\CalenderController::class, 'getAllAcceptedBookingDoctors'])->name('calender.getAllAcceptedBookingDoctors');
        Route::post('/store-booking', [\Modules\Calender\Http\Controllers\CalenderController::class, 'storeBookingForChild'])->name('calender.store_booking');
        Route::get('/booking/{calender}', [\Modules\Calender\Http\Controllers\CalenderController::class, 'show'])->name('calender.event.show');
        Route::post('/booking/child/report', [\Modules\Calender\Http\Controllers\CalenderController::class, 'getLatestReportForChild'])->name('calender.getLatestReportForChild');
    });
});


Route::middleware('auth:api')->group(function () {
    Route::group(['prefix' => 'calender'], function () {
        Route::get('/bookings', [\Modules\Calender\Http\Controllers\CalenderController::class, 'getAllBooking'])->name('calender.bookings');
        Route::post('/change-doctor', [\Modules\Calender\Http\Controllers\CalenderController::class, 'changeDoctor'])->name('calender.changeDoctor');
        Route::patch('/bookings/{booking}', [\Modules\Calender\Http\Controllers\CalenderController::class, 'updateBooking'])->name('calender.updateBooking');
        Route::get('/bookings/{booking}', [\Modules\Calender\Http\Controllers\CalenderController::class, 'showBooking'])->name('calender.booking');
        Route::post('/bookings/{booking}/accept', [\Modules\Calender\Http\Controllers\CalenderController::class, 'acceptBooking'])->name('accept.booking');
        Route::get('/', [\Modules\Calender\Http\Controllers\CalenderController::class, 'index'])->name('calender.index');
        Route::post('/create', [\Modules\Calender\Http\Controllers\CalenderController::class, 'store'])->name('calender.create');
        Route::get('/{calender}', [\Modules\Calender\Http\Controllers\CalenderController::class, 'show'])->name('calender.show');
        Route::post('/{calender}/update', [\Modules\Calender\Http\Controllers\CalenderController::class, 'update'])->name('calender.update');
        Route::delete('/{calender}/delete', [\Modules\Calender\Http\Controllers\CalenderController::class, 'destroy'])->name('calender.delete');
    });
});
