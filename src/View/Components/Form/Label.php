<?php

namespace XForm\View\Components\Form;

use Closure;
use Illuminate\View\Component;
use Illuminate\View\View;

class Label extends Component
{

    public function __construct(
        public ?string $for = '',
        public ?string $label = '',
        public ?string $model = '',
        public ?string $modifier = '',
        public ?string $icon = '',
        public ?string $tooltip = '',
        public ?bool $required = false
    )
    {
        //...
    }

    public function render(): View|Closure|string
    {
        return view('x-form::label');
    }
}
