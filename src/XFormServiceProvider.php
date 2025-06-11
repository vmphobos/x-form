<?php

namespace Vmphobos\XForm;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class XFormServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'x-form');
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
        $this->publishes([
            __DIR__.'/../config/x-form.php' => config_path('x-form.php'),
        ], 'xform-config');
    }

    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/x-form.php', 'x-form');
    }
}
