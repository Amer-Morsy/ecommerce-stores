<?php

use App\Http\Controllers\Dashboard\AdminController;
use Illuminate\Support\Facades\Route;


Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => [
        'localeSessionRedirect',
        'localizationRedirect',
        'localeViewPath'
    ]
], function () {
    Route::group(['middleware' => 'auth:admin', 'prefix' => 'admin', 'namespace' => 'Dashboard'], function () {
        route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');
        route::get('/logout', [AdminController::class, 'logout'])->name('admin.logout');

        Route::group(['prefix' => 'profile'], function () {
            Route::get('edit', [AdminController::class, 'editProfile'])
                ->name('edit.profile');
            Route::put('update', [AdminController::class, 'updateProfile'])
                ->name('update.profile');
        });
    });

    Route::group(['middleware' => 'guest:admin', 'prefix' => 'admin', 'namespace' => 'Dashboard'], function () {
        route::get('/login', [AdminController::class, 'login'])->name('admin.login');
        route::post('/login', [AdminController::class, 'loginCheck'])->name('admin.login.check');
    });
});
