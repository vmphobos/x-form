<?php

namespace XForm\View\Components\Form;

use Closure;
use Illuminate\View\Component;
use Illuminate\View\View;

class Disabled extends Component
{
    public function __construct(
        public ?string $label = null,
        public ?string $value = null,
        public ?string $floating = null,
        public ?string $icon = null,
        public ?string $tooltip = null,
        public ?bool $selectable = false,
        public ?bool $mail = false,
        public ?bool $phone = false,
        public ?bool $fax = false,
        public ?bool $map = false,
    )
    {
        /**
         *  SO DISABLED
         */
    }

    public function render(): View|Closure|string
    {
        return view('x-form::disabled');
    }
}
