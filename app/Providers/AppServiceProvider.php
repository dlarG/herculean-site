<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

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
        Blade::directive('sportImage', function ($expression) {
            return "<?php
                \$sportName = $expression;
                \$slug = Str::slug(\$sportName);
                \$specific = 'assets/sports/' . \$slug . '.jpg';
                \$fallback = 'assets/sports/_default.jpg';
                echo file_exists(public_path(\$specific)) ? asset(\$specific) : asset(\$fallback);
            ?>";
        });
    }
}
