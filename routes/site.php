<?php

use Illuminate\Support\Facades\Route;


Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => [
        'localeSessionRedirect',
        'localizationRedirect',
        'localeViewPath'
    ]
], function () {
    Route::group(['prefix'=> ''], function(){
        route::get('/', function (){
            return 'Site';
        })->name('home');
    });
});
