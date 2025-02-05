<?php

use App\Http\Controllers\Site\HomeController;
use Illuminate\Support\Facades\Route;


Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => [
        'localeSessionRedirect',
        'localizationRedirect',
        'localeViewPath'
    ]
], function () {
    Route::group(['namespace' => 'Site'], function () {
        route::get('/', [HomeController::class, 'home'])->name('home');

    });
});
