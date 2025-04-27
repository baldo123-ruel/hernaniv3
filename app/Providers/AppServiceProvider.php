<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        if (app()->environment('production')) {
            URL::forceScheme('https');

            // If still accessed via HTTP, force redirect to HTTPS
            if (request()->header('x-forwarded-proto') != 'https') {
                return redirect()->secure(request()->getRequestUri());
            }
        }
    }
}
