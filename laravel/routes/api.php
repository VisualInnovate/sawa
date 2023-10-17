<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\PermissionController;
use App\Http\Controllers\Api\PassportAuthController;
use App\Http\Controllers\Api\FrontAuthController;
use App\Http\Controllers\Api\SiteSettingsController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\ParentController;
use Illuminate\Http\Request;

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

// Route::middleware('auth:parent')->get('/user', function (Request $request) {
//     return $request->user();
// });




Route::post('register', [PassportAuthController::class, 'register'])->name('register.perform');
Route::post('login', [PassportAuthController::class, 'login'])->name('login.perform');
Route::post('/forgot-password', [PassportAuthController::class, 'forgotPassword'])->name('password.forgot');
Route::post('/reset-password', [PassportAuthController::class, 'resetPassword'])->name('password.reset');
Route::get('/doctors', [FrontAuthController::class, 'doctors'])->name('doctors');
Route::get('lookups/treatmentsType', [\App\Http\Controllers\LookupsController::class, 'treatmeantType']);


Route::post('/set-language', [LanguageController::class, 'setLanguage']);
Route::get('/languages', [LanguageController::class, 'getLangs']);

Route::get('/countries', [CountryController::class, 'getCountries']);


Route::apiResource("admin-parents", ParentController::class);


Route::controller(FrontAuthController::class)->prefix('parent')->as('parent.')->group(function () {
    Route::post('register', 'register')->name('register');
    Route::post('login', 'login')->name('login');

    Route::middleware(['auth:parent', 'phone_verified'])->group(function () {
        Route::post('profile', 'profile')->name('profile');
        Route::get('user', 'user')->name('user');
        Route::get('notification', 'getParentNotification')->name('notification');
    });

    Route::middleware('auth:parent')->group(function () {
        Route::post('logout', 'logout')->name('logout');
        Route::post('send-otp', 'sendOTP')->name('send_otp');
        Route::post('validate-otp', 'validateOTP')->name('validate_otp');
    });
});


Route::middleware('auth:api')->group(function () {
    Route::get('get-user', [PassportAuthController::class, 'userInfo'])->name('users.get');
    Route::post('logout', [PassportAuthController::class, 'logout'])->name('logout.perform');



    Route::controller(SiteSettingsController::class)->prefix('site')->as('site.')->group(function () {
        Route::get('settings', 'index_settings')->name('settings');
        Route::post('settings', 'update_settings')->name('settings.update');

        Route::get('pages', 'index_pages')->name('pages');
        Route::post('pages', 'store_page')->name('pages.store');
        Route::post('pages/{page}', 'update_page')->name('pages.update');
    });


    /**
     * roles
     */
    Route::group(['prefix' => 'roles'], function () {
        Route::post('/', [RoleController::class, 'index'])->name('roles.index');
        Route::post('/create', [RoleController::class, 'store'])->name('roles.create');
        Route::get('/{role}', [RoleController::class, 'show'])->name('roles.show');
        Route::put('/{role}/edit', [RoleController::class, 'update'])->name('roles.edit');
        Route::delete('/{role}/delete', [RoleController::class, 'destroy'])->name('roles.delete');
    });

    /**
     * permissions
     */
    Route::group(['prefix' => 'permissions'], function () {
        Route::post('/', [PermissionController::class, 'index'])->name('permissions.index');
        Route::post('/create', [PermissionController::class, 'store'])->name('permissions.create');
        Route::get('/{permission}', [PermissionController::class, 'show'])->name('permissions.show');
        Route::put('/{permission}/edit', [PermissionController::class, 'update'])->name('permissions.edit');
        Route::delete('/{permission}/delete', [PermissionController::class, 'destroy'])->name('permissions.delete');
    });

    /**
     * users
     */
    Route::group(['prefix' => 'users'], function () {
        Route::post('/', [UserController::class, 'index'])->name('users.index');
        Route::post('/create', [UserController::class, 'store'])->name('users.create');
        Route::get('/{user}', [UserController::class, 'show'])->name('users.show');
        Route::post('/{user}/edit', [UserController::class, 'update'])->name('users.edit');
        Route::delete('/{user}/delete', [UserController::class, 'destroy'])->name('users.delete');
        Route::post('/{user}/add-permissions', [UserController::class, 'addPermissions'])->name('users.addPermissions');
        Route::get('/{user}/permissions', [UserController::class, 'getUserPermissions'])->name('users.getUserPermissions');
        Route::post('/{user}/sync-permissions', [UserController::class, 'syncPermissions'])->name('users.syncPermissions');
    });
});
