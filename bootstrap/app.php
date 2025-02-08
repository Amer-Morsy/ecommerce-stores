<?php


use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
    web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
        then: function ()
{
    Route::middleware('web')
        ->group(base_path('routes/site.php'));

    Route::middleware('web')
//                ->prefix('webhooks')
//                ->name('webhooks.')
        ->group(base_path('routes/admin.php'));
},
    )
    ->withMiddleware(function (Middleware $middleware) {
    $middleware->alias([
        /**** OTHER MIDDLEWARE ALIASES ****/
        'localize' => \Mcamara\LaravelLocalization\Middleware\LaravelLocalizationRoutes::class,
        'localizationRedirect' => \Mcamara\LaravelLocalization\Middleware\LaravelLocalizationRedirectFilter::class,
        'localeSessionRedirect' => \Mcamara\LaravelLocalization\Middleware\LocaleSessionRedirect::class,
        'localeCookieRedirect' => \Mcamara\LaravelLocalization\Middleware\LocaleCookieRedirect::class,
        'localeViewPath' => \Mcamara\LaravelLocalization\Middleware\LaravelLocalizationViewPath::class,
        'verifiedUser' => \App\Http\Middleware\VerifyCode::class,
    ]);

    $middleware->redirectGuestsTo(fn(Request $request) => $request->is(app()->getLocale() . '/admin*')
        ? route('admin.login')
        : route('login')
    );
    $middleware->redirectUsersTo(fn(Request $request) => $request->is(app()->getLocale() . '/admin*')
        ? route('admin.dashboard')
        : route('home')
    );
})
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
