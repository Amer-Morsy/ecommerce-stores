<?php

use App\Http\Controllers\Site\CartController;
use App\Http\Controllers\Site\CategoryController;
use App\Http\Controllers\Site\HomeController;
use App\Http\Controllers\Site\PaymentController;
use App\Http\Controllers\Site\ProductController;
use App\Http\Controllers\Site\VerificationCodeController;
use App\Http\Controllers\Site\WishlistController;
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

        Route::group(['prefix' => 'cart'], function () {
            Route::get('/', [CartController::class, 'getIndex'])->name('site.cart.index');
            Route::post('/cart/add/{slug?}', [CartController::class, 'postAdd'])->name('site.cart.add');
            Route::post('/update/{slug}', [CartController::class, 'postUpdate'])->name('site.cart.update');
            Route::post('/update-all', [CartController::class, 'postUpdateAll'])->name('site.cart.update-all');
        });

    });

    Route::group(['namespace' => 'Site', 'middleware' => 'auth'], function () {
        // must be authenticated user
        Route::post('verify-user/', [VerificationCodeController::class, 'verify'])->name('verify-user');
        Route::get('verify', [VerificationCodeController::class, 'getVerifyPage'])->name('get.verification.form');
        Route::get('wishlist/products', [WishlistController::class, 'index'])->name('wishlist.products.index');
        Route::post('wishlist', [WishlistController::class, 'store'])->name('wishlist.store');
        Route::delete('wishlist', [WishlistController::class, 'destroy'])->name('wishlist.destroy');
        Route::get('payment/{amount}', [PaymentController::class, 'getPayments']) -> name('payment');
        Route::post('payment', [PaymentController::class,'processPayment']) -> name('payment.process');

    });

    Route::group(['namespace' => 'Site', 'middleware' => ['auth', 'verifiedUser']], function () {
        // must be authenticated user and verified
        Route::get('profile', function () {
            return 'You Are Authenticated ';
        });
    });
});
