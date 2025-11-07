<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\TahunPelajaran;

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
        View::composer('layouts.admin', function ($view) {
            $tahunAktif = TahunPelajaran::where('status', 'Aktif')->first();

        // Bagikan data $tahunAktif ke semua view 'layouts.admin'
            $view->with('tahunAktif', $tahunAktif);
        });
    }
}
