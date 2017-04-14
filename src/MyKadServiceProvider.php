<?php

namespace TelcoLAB\MyKad;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use TelcoLAB\Extender\Extender;
use TelcoLAB\MyKad\Validations\Validator;

class MyKadServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadTranslationsFrom(__DIR__ . '/assets/lang', 'extender');
        $extender = (new Extender)->make(Validator::class);
        $extender->extend();
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
