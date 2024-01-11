<?php

namespace XForm\View\Components\Form;

use Closure;
use Illuminate\View\Component;
use Illuminate\View\View;

class Disabled extends Component
{
    public function __construct(
        public ?string $label = '',
        public ?string $value = '',
        public ?string $floating = '',
        public ?string $icon = '',
        public ?string $tooltip = '',
        public ?bool $selectable = false,
        public ?bool $link = false,
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
