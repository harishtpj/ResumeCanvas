<?php

namespace App\Providers;

use App\Models\User;
use App\Models\Portfolio;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Access\Response;
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
    public function boot(UrlGenerator $url): void
    {
        Gate::define('is-shared', function (?User $user, Portfolio $portfolio) {
            return $portfolio->shared ? Response::allow() : Response::denyAsNotFound();
        });

        if (App::environment('production')) {
            $url->forceHttps();
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
