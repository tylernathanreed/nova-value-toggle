<?php

namespace Reedware\NovaValueToggle;

use Laravel\Nova\Nova;
use Laravel\Nova\Fields\Field;
use Laravel\Nova\Events\ServingNova;
use Illuminate\Support\ServiceProvider;

class FieldServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Register the value toggle assets
        Nova::serving(function(ServingNova $event) {

            Nova::script('ValueToggle', __DIR__.'/../dist/js/field.js');
            Nova::style('ValueToggle', __DIR__.'/../dist/css/field.css');

        });

        // Add the "valueToggle" macro to fields
        Field::macro('valueToggle', function($callback) {
            return ValueToggle::make($this, $callback);
        });
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
