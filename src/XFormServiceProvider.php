<?php

namespace Vmphobos\XForm;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Vmphobos\XForm\Console\Commands\XFormAutoInstaller;
use Vmphobos\XForm\View\Components\Form\Checkbox;
use Vmphobos\XForm\View\Components\Form\Disabled;
use Vmphobos\XForm\View\Components\Form\File;
use Vmphobos\XForm\View\Components\Form\Input;
use Vmphobos\XForm\View\Components\Form\Label;
use Vmphobos\XForm\View\Components\Form\Radio;
use Vmphobos\XForm\View\Components\Form\Select;
use Vmphobos\XForm\View\Components\Form\Textarea;

class XFormServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        //Config
        $this->publishes([__DIR__ . '/../config/x-form.php' => $this->getConfigPath()], 'x-form:config');

        //Components
        $this->loadViewsFrom(__DIR__.'/../resources/views/components/form', 'x-form');

        $this->publishes([
            __DIR__ . '/../resources/views/components/form' => resource_path('views/vendor/x-form'),
        ], 'x-form:views');

        $this->registerBladeComponents();

        if ($this->app->runningInConsole()) {
            $this->commands([XFormAutoInstaller::class]);
        }
    }

    public function register(): void
    {
        // Merge package config with the app's config
        $this->mergeConfigFrom(__DIR__.'/../config/x-form.php', 'x-form');

        // Autoload helpers
        if (file_exists($helpers = __DIR__.'/helpers.php')) {
            require_once $helpers;
        }
    }

    protected function registerBladeComponents(): void
    {
        Blade::component('form.checkbox-group', Checkbox::class);
        Blade::component('form.checkbox', Checkbox::class);
        Blade::component('form.input', Input::class);
        Blade::component('form.label', Label::class);
        Blade::component('form.radio', Radio::class);
        Blade::component('form.select', Select::class);
        Blade::component('form.file', File::class);
        Blade::component('form.textarea', Textarea::class);
        Blade::component('form.disabled', Disabled::class);
    }

    public function provides()
    {
        return ['x-form'];
    }

    protected function getConfigPath()
    {
        return config_path('x-form.php');
    }
}

