<?php

use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Middleware\LaravelLocalizationRedirectFilter;

Route::prefix(LaravelLocalization::setLocale())
    ->middleware([
        LaravelLocalizationRedirectFilter::class,
    ])
    ->group(function () {
        Route::get('/{slug?}', PageController::class)->where(['path' => '.*']);
    });
