<?php

namespace App\Providers;

use App\Notifikasi;
use Illuminate\Pagination\Paginator;
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
        Paginator::useBootstrap();

        view()->composer('layouts.admin', function ($view) {
            $alerts = Notifikasi::orderByDesc('tgl_kirim')->limit(5)->get();
            $alertCount = Notifikasi::where('is_read', false)->count();

            $view->with([
                'alerts' => $alerts,
                'alertCount' => $alertCount,
            ]);
        });
    }
}
