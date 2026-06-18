<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Inertia\ExceptionResponse;
use Inertia\Inertia;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (!config('app.debug')) {
            Inertia::handleExceptionsUsing(function (ExceptionResponse $resp) {
                if (in_array($resp->statusCode(), [403, 404, 500, 503])) {
                    return $resp->render('ErrorPage', [
                        'code' => $resp->statusCode(),
                    ])->withSharedData();
                }
            });
        }
    }
}
