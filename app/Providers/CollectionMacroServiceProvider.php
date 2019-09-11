<?php

// Based on the `spatie/laravel-collection-macros` library
// https://github.com/spatie/laravel-collection-macros/blob/8b4d11767678eb2504a9b6a1012862e196cab0fa/src/CollectionMacroServiceProvider.php

namespace App\Providers;

use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider;

class CollectionMacroServiceProvider extends ServiceProvider
{
    public function register()
    {
        Collection::make(glob(__DIR__.'/../Macros/*.php'))
            ->mapWithKeys(function ($path) {
                return [$path => pathinfo($path, PATHINFO_FILENAME)];
            })
            ->reject(function ($macro) {
                return Collection::hasMacro($macro);
            })
            ->each(function ($macro, $path) {
                $class = 'App\\Macros\\'.$macro;
                Collection::macro(Str::camel($macro), app($class)());
            });
    }
}
