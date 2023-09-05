<?php

namespace App\Providers;

use App\PO;
use App\Presentasi;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

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
        Blade::directive('currency', function ($expression) {
            return "Rp <?php echo number_format($expression, 0, ',', '.'); ?>";
        });

        view()->composer('layouts.home', function($view)
        {
            $presentasi = Presentasi::where('status', 'Proses')->count();
            $view->with('presentasi', $presentasi);
        });

        view()->composer('layouts.home', function($view)
        {
            $po = PO::where('progress', 'Belum Diproses')->count();
            $view->with('po', $po);
        });
    }
}
