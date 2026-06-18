<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Redirect setelah login (dipakai middleware 'guest')
     * Kita arahkan ke /masyarakat/dashboard sebagai default
     * karena role ditangani di AuthController
     */
    public const HOME = '/masyarakat/dashboard';

    public function boot(): void
    {
        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });
    }
}