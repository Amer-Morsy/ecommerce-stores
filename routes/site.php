<?php

use App\Http\Controllers\Site\CategoryController;
use App\Http\Controllers\Site\HomeController;
use App\Http\Controllers\Site\ProductController;
use App\Http\Controllers\Site\VerificationCodeController;
use Illuminate\Support\Facades\Route;


Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => [
        'localeSessionRedirect',
        'localizationRedirect',
        'localeViewPath'
    ]
], function () {

    Auth::routes();

    Route::group(['namespace' => 'Site'], function () {
        route::get('/', [HomeController::class, 'home'])->name('home');
        route::get('/category/{slug}', [CategoryController::class, 'productsBySlug'])->name('category');
        route::get('/product/{slug}', [ProductController::class, 'productsBySlug'])->name('product.details');

    });

    Route::group(['namespace' => 'Site', 'middleware' => 'auth'], function () {
        // must be authenticated user
        Route::post('verify-user/', [VerificationCodeController::class, 'verify'])->name('verify-user');
        Route::get('verify', [VerificationCodeController::class, 'getVerifyPage'])->name('get.verification.form');

    });

    Route::group(['namespace' => 'Site', 'middleware' => ['auth', 'verifiedUser']], function () {
        // must be authenticated user and verified
        Route::get('profile', function () {
            return 'You Are Authenticated ';
        });
    });
});
