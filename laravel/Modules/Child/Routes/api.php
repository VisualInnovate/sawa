<?php

use Illuminate\Http\Request;
use Modules\Child\Http\Controllers\ChildController;

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

Route::get('child/{child}/show-side-profiles', [ChildController::class, 'getChildAndSideProfile'])->name('child.getChildAndSideProfile');


Route::middleware('auth:api')->group(function () {

    Route::group(['prefix' => 'child'], function () {
        Route::get('/', [ChildController::class, 'index'])->name('child.index');
        Route::post('/create', [ChildController::class, 'store'])->name('create');

        Route::get('/{child}/{evaluation}', [ChildController::class, 'childAndEvaluation'])->name('child.childAndEvaluation');
        Route::post('/results', [ChildController::class, 'getResultsWithSideprofile'])->name('child.results');
        Route::get('/{child}', [ChildController::class, 'show'])->name('child.show');
        Route::post('/{child}/update', [ChildController::class, 'update'])->name('child.update');
        Route::delete('/{child}/delete', [ChildController::class, 'destroy'])->name('child.delete');
    });
});


// This Is Temp For Parent Until We Remove The Above Routes.
Route::middleware(['auth:parent', 'phone_verified'])->prefix('parent')->as('parent.')->group(function () {
    Route::group(['prefix' => 'child'], function () {
        Route::post('/create', [ChildController::class, 'store'])->name('create');

        Route::get('/all', [ChildController::class, 'getParentChilds'])->name('all');
        Route::get('/{child}', [ChildController::class, 'show'])->name('child.show');
        Route::post('/{child}/update', [ChildController::class, 'update'])->name('child.update');
        Route::delete('/{child}/delete', [ChildController::class, 'destroy'])->name('child.delete');
    });
});




