<?php

namespace Hackshadetechs\MatovuRonaldTheme;

use Laravel\Nova\Nova;
use Laravel\Nova\Events\ServingNova;
use Illuminate\Support\ServiceProvider;

class ThemeServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Nova::theme(asset('/hackshadetechs/matovu-ronald-theme/theme.css'));

        $this->publishes([
            __DIR__.'/../resources/css' => public_path('hackshadetechs/matovu-ronald-theme'),
        ], 'public');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
