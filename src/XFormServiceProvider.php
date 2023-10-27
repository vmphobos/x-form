<?php

namespace XForm;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use XForm\Console\Commands\XFormInstallationCommand;
use XForm\View\Components\Form\Checkbox;
use XForm\View\Components\Form\Disabled;
use XForm\View\Components\Form\JsScripts;
use XForm\View\Components\Form\Input;
use XForm\View\Components\Form\Label;
use XForm\View\Components\Form\Radio;
use XForm\View\Components\Form\Select;
use XForm\View\Components\Form\Textarea;


class XFormServiceProvider extends ServiceProvider
{
    /**
     * Register the application services.
     */

    public function boot(): void
    {
        Blade::component('form.checkbox', Checkbox::class);
        Blade::component('form.input', Input::class);
        Blade::component('form.label', Label::class);
        Blade::component('form.radio', Radio::class);
        Blade::component('form.select', Select::class);
        Blade::component('form.textarea', Textarea::class);
        Blade::component('form.disabled', Disabled::class);
        Blade::component('form.scripts', JsScripts::class);

        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
    }

    /**
     * Register any package services.
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/x-form.php', 'x-form');

        // Register the service provider of the package.
        $this->app->singleton('x-form', function ($app) {
            return new XForm;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['x-form'];
    }

    /**
     * Console-specific booting.
     */
    protected function bootForConsole(): void
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__.'/../config/x-form.php' => config_path('x-form.php'),
        ], 'x-form.config');

        $this->commands([XFormInstallationCommand::class]);
    }
}
