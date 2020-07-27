<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Schema\Builder; // Import Builder where defaultStringLength method is defined
use Illuminate\Support\Facades\Schema;

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
        // Builder::defaultStringLength(255); // Update defaultStringLength
        Schema::defaultStringLength(191);
        // if(config('app.env') === 'production') {
        //     \URL::forceScheme('https');
        // }else{
        //     \URL::forceScheme('https');
        // }
    }
}
