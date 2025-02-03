<?php

use App\Http\Controllers\Dashboard\AdminController;
use App\Http\Controllers\dashboard\AttributeController;
use App\Http\Controllers\Dashboard\BrandController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\OptionController;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Dashboard\SettingController;
use App\Http\Controllers\Dashboard\SliderController;
use App\Http\Controllers\Dashboard\TagController;
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

        ### settings ###
        Route::group(['prefix' => 'settings'], function () {
            Route::get('shipping-methods/{type}', [SettingController::class, 'editShippingMethods'])
                ->name('edit.shipping.methods');
            Route::put('shipping-methods/{id}', [SettingController::class, 'updateShippingMethods'])
                ->name('update.shipping.methods');
        });
        ### end settings ###
        ### Categories   ###
        Route::group(['prefix' => 'categories'], function () {
            Route::get('/', [CategoryController::class, 'index'])->name('admin.categories');
            Route::get('create', [CategoryController::class, 'create'])->name('admin.categories.create');
            Route::post('store', [CategoryController::class, 'store'])->name('admin.categories.store');
            Route::get('edit/{id}', [CategoryController::class, 'edit'])->name('admin.categories.edit');
            Route::post('update/{id}', [CategoryController::class, 'update'])->name('admin.categories.update');
            Route::get('delete/{id}', [CategoryController::class, 'destroy'])->name('admin.categories.delete');
        });
        ### end Categories ####
        ### brands         ####
        Route::group(['prefix' => 'brands'], function () {
            Route::get('/', [BrandController::class, 'index'])->name('admin.brands');
            Route::get('create', [BrandController::class, 'create'])->name('admin.brands.create');
            Route::post('store', [BrandController::class, 'store'])->name('admin.brands.store');
            Route::get('edit/{id}', [BrandController::class, 'edit'])->name('admin.brands.edit');
            Route::post('update/{id}', [BrandController::class, 'update'])->name('admin.brands.update');
            Route::get('delete/{id}', [BrandController::class, 'destroy'])->name('admin.brands.delete');
        });
        ### end brands ###
        ### Tags ###
        Route::group(['prefix' => 'tags'], function () {
            Route::get('/', [TagController::class, 'index'])->name('admin.tags');
            Route::get('create', [TagController::class, 'create'])->name('admin.tags.create');
            Route::post('store', [TagController::class, 'store'])->name('admin.tags.store');
            Route::get('edit/{id}', [TagController::class, 'edit'])->name('admin.tags.edit');
            Route::post('update/{id}', [TagController::class, 'update'])->name('admin.tags.update');
            Route::get('delete/{id}', [TagController::class, 'destroy'])->name('admin.tags.delete');
        });
        ### end brands ###
        ### products ###
        Route::group(['prefix' => 'products'], function () {
            Route::get('/', [ProductController::class, 'index'])
                ->name('admin.products');
            Route::get('general-information', [ProductController::class, 'create'])
                ->name('admin.products.general.create');
            Route::post('store-general-information', [ProductController::class, 'store'])
                ->name('admin.products.general.store');

            Route::get('price/{id}', [ProductController::class, 'getPrice'])
                ->name('admin.products.price');
            Route::post('price', [ProductController::class, 'saveProductPrice'])
                ->name('admin.products.price.store');

            Route::get('stock/{id}', [ProductController::class, 'getStock'])
                ->name('admin.products.stock');
            Route::post('stock', [ProductController::class, 'saveProductStock'])
                ->name('admin.products.stock.store');

            Route::get('images/{id}', [ProductController::class, 'addImages'])
                ->name('admin.products.images');
            Route::post('images', [ProductController::class, 'saveProductImages'])
                ->name('admin.products.images.store');
            Route::post('images/db', [ProductController::class, 'saveProductImagesDB'])
                ->name('admin.products.images.store.db');
        });
        ### end products ###

        ### attributes ###
        Route::group(['prefix' => 'attributes'], function () {
            Route::get('/', [AttributeController::class, 'index'])->name('admin.attributes');
            Route::get('create', [AttributeController::class, 'create'])->name('admin.attributes.create');
            Route::post('store', [AttributeController::class, 'store'])->name('admin.attributes.store');
            Route::get('edit/{id}', [AttributeController::class, 'edit'])->name('admin.attributes.edit');
            Route::post('update/{id}', [AttributeController::class, 'update'])->name('admin.attributes.update');
            Route::get('delete/{id}', [AttributeController::class, 'destroy'])->name('admin.attributes.delete');
        });
        ### end attributes ###

        ### options ###
        Route::group(['prefix' => 'options'], function () {
            Route::get('/', [OptionController::class, 'index'])->name('admin.options');
            Route::get('create', [OptionController::class, 'create'])->name('admin.options.create');
            Route::post('store', [OptionController::class, 'store'])->name('admin.options.store');
            Route::get('edit/{id}', [OptionController::class, 'edit'])->name('admin.options.edit');
            Route::post('update/{id}', [OptionController::class, 'update'])->name('admin.options.update');
            Route::get('delete/{id}', [OptionController::class, 'destroy'])->name('admin.options.delete');
        });
        ### end options ###

        ### sliders ###
        Route::group(['prefix' => 'sliders'], function () {
            Route::get('/', [SliderController::class, 'addImages'])->name('admin.sliders.create');
            Route::post('images', [SliderController::class, 'saveSliderImages'])->name('admin.sliders.images.store');
            Route::post('images/db', [SliderController::class, 'saveSliderImagesDB'])->name('admin.sliders.images.store.db');

        });
        ### end sliders ###

    });

    Route::group(['middleware' => 'guest:admin', 'prefix' => 'admin', 'namespace' => 'Dashboard'], function () {
        route::get('/login', [AdminController::class, 'login'])->name('admin.login');
        route::post('/login', [AdminController::class, 'loginCheck'])->name('admin.login.check');
    });
});
