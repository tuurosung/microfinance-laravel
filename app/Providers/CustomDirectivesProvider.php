<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class CustomDirectivesProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Blade::directive("ghs", function ($expression) {
            return "<?php echo \App\Services\PesewasToCedis::fromPesewas($expression); ?>";
        });
    }
}
