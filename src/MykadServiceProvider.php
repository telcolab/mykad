<?php

namespace TelcoLAB\MyKad;

use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
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
        $this->loadTranslationsFrom(__DIR__ . '/assets/lang', 'mykad');
        $this->extendValidation(Validator::class);
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

    public function extendValidation($class)
    {
        $classes = is_array($class) ? $class : [$class];

        foreach ($classes as $class) {
            if (class_exists($class) && $methods = get_class_methods($class)) {
                $validations = Collection::make($methods)->reduce(function ($filtered, $item) {
                    if (Str::startsWith($item, 'validate')) {
                        $filtered[$item] = Str::snake($strip = str_replace('validate', '', $item));
                    }
                    return $filtered;
                });

                foreach ($validations as $methodName => $validationName) {
                    $message = $this->app->translator->trans('mykad::validation.' . $validationName);
                    $this->app->validator->extend($validationName, $class . '@' . $methodName, $message);
                }
            }
        }
    }
}
