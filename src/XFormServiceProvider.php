<?php

namespace Vmphobos\XForm;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class XFormServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        // Load views from the 'resources/views/components' directory in the package
        $this->loadViewsFrom(__DIR__.'/../resources/views/components', 'x-form');

        // Register components under the 'form' namespace
        $this->loadViewComponentsAs('form', [
            \Vmphobos\XForm\View\Components\Form\Checkbox::class,
            \Vmphobos\XForm\View\Components\Form\Disabled::class,
            \Vmphobos\XForm\View\Components\Form\File::class,
            \Vmphobos\XForm\View\Components\Form\Input::class,
            \Vmphobos\XForm\View\Components\Form\Label::class,
            \Vmphobos\XForm\View\Components\Form\Radio::class,
            \Vmphobos\XForm\View\Components\Form\Select::class,
            \Vmphobos\XForm\View\Components\Form\Textarea::class,
        ]);

        // Publish the configuration file
        $this->publishes([
            __DIR__.'/../config/x-form.php' => config_path('x-form.php'),
        ], 'xform-config');
    }

    public function register(): void
    {
        // Merge package config with the app's config
        $this->mergeConfigFrom(__DIR__.'/../config/x-form.php', 'x-form');
    }
}

