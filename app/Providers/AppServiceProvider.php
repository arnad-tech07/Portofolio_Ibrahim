<?php

namespace App\Providers;

use App\Models\ProfileSetting;
use Illuminate\Support\Facades\View;
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
        View::composer([
            'layouts.app',
            'partials.header',
            'partials.sidebar',
            'partials.footer',
            'partials.carousel',
            'partials.cv_profile',
            'partials.kontak',
        ], function ($view): void {
            $view->with('profile', ProfileSetting::query()->first());
        });
    }
}
