<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Providers\Carbon;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // for indonesia
        // config(['app.locale' => 'id']);
        // Carbon::setLocale('id');
    }
}
