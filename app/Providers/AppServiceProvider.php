<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Carbon\Carbon;

class AppServiceProvider extends ServiceProvider
{


    public function boot(): void
    {
        Carbon::setLocale('pt_BR');
    }

    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

}
