<?php

namespace Vmphobos\XForm\View\Components\Form;

use Closure;
use Illuminate\View\Component;
use Illuminate\View\View;

class Disabled extends Component
{
    public function __construct(
        public ?string $label = null,
        public ?string $value = null,
        public ?string $icon = null,
        public ?string $tooltip = null,
        public ?string $prepend = null,
        public ?string $append = null,
        public ?bool $currency = false,
        public ?bool $copy = false,
        public ?bool $link = false,
        public ?bool $mail = false,
        public ?bool $phone = false,
        public ?bool $fax = false,
        public ?bool $map = false,
    )
    {}

    public function render(): View|Closure|string
    {
        return view('x-form::components.form.disabled');
    }
}
