<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
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
        Carbon::setLocale(env('LOCALE', 'id'));

        Blade::if('notRole', function ($role) {
            return !auth()->check() || !auth()->user()->hasRole($role);
        });
        Blade::directive('money', function ($expression) {
            return "<?php echo 'Rp. ' . number_format($expression, 0, ',', '.'); ?>";
        });

        // Extend @auth untuk guard ppdb
        Blade::if('auth', function ($guard = null) {
            return Auth::guard($guard)->check();
        });

        // Extend @guest untuk guard ppdb
        Blade::if('guest', function ($guard = null) {
            return !Auth::guard($guard)->check();
        });
    }
}
