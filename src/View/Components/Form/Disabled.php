<?php

namespace Vmphobos\XForm\View\Components\Form;

use Closure;
use Illuminate\View\Component;
use Illuminate\View\ComponentAttributeBag;
use Illuminate\View\View;

class Disabled extends Component
{
    public function __construct(
        ComponentAttributeBag $attributes,
        public ?string $label = null,
        public ?string $value = null,
        public ?string $icon = null,
        public ?string $tooltip = null,
        public ?string $prepend = null,
        public ?string $append = null,
        public bool $currency = false,
        public bool $copy = false,
        public bool $link = false,
        public bool $mail = false,
        public bool $phone = false,
        public bool $fax = false,
        public bool $map = false,
    )
    {
        foreach (['currency', 'copy', 'link', 'mail', 'phone', 'fax', 'map'] as $key) {
            if ($attributes->has($key)) {
                $this->{$key} = true;
            }
        }
    }

    public function render(): View|Closure|string
    {
        return view('x-form::disabled');
    }
}
