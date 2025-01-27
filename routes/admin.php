<?php

use App\Http\Controllers\Dashboard\AdminController;
use App\Http\Controllers\Dashboard\BrandController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\SettingController;
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

        ### start settings routes ########################################
        Route::group(['prefix' => 'settings'], function () {
            Route::get('shipping-methods/{type}', [SettingController::class, 'editShippingMethods'])
                ->name('edit.shipping.methods');
            Route::put('shipping-methods/{id}', [SettingController::class, 'updateShippingMethods'])
                ->name('update.shipping.methods');
        });
        ### end settings routes ##########################################
        ### start Categories routes ###################################################
        Route::group(['prefix' => 'categories'], function () {
            Route::get('/', [CategoryController::class, 'index'])->name('admin.categories');
            Route::get('create', [CategoryController::class, 'create'])->name('admin.categories.create');
            Route::post('store', [CategoryController::class, 'store'])->name('admin.categories.store');
            Route::get('edit/{id}', [CategoryController::class, 'edit'])->name('admin.categories.edit');
            Route::post('update/{id}', [CategoryController::class, 'update'])->name('admin.categories.update');
            Route::get('delete/{id}', [CategoryController::class, 'destroy'])->name('admin.categories.delete');
        });
        ### end Categories routes #####################################################
        ################################## brands routes ######################################
        Route::group(['prefix' => 'brands'], function () {
            Route::get('/', [BrandController::class, 'index'])->name('admin.brands');
            Route::get('create', [BrandController::class, 'create'])->name('admin.brands.create');
            Route::post('store', [BrandController::class, 'store'])->name('admin.brands.store');
            Route::get('edit/{id}', [BrandController::class, 'edit'])->name('admin.brands.edit');
            Route::post('update/{id}', [BrandController::class, 'update'])->name('admin.brands.update');
            Route::get('delete/{id}', [BrandController::class, 'destroy'])->name('admin.brands.delete');
        });
        ################################## end brands    #######################################
    });

    Route::group(['middleware' => 'guest:admin', 'prefix' => 'admin', 'namespace' => 'Dashboard'], function () {
        route::get('/login', [AdminController::class, 'login'])->name('admin.login');
        route::post('/login', [AdminController::class, 'loginCheck'])->name('admin.login.check');
    });
});
