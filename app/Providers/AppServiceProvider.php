<?php

namespace App\Providers;

use App\Models\PpdbRegistrationUser;
use App\Models\PpdbUser;
use App\Observers\PpdbRegistrationUserObserver;
use App\Observers\PpdbUserObserver;
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

        PpdbUser::observe(PpdbUserObserver::class);
        PpdbRegistrationUser::observe(PpdbRegistrationUserObserver::class);

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
