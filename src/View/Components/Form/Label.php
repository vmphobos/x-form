<?php

namespace XForm\View\Components\Form;

use Closure;
use Illuminate\View\Component;
use Illuminate\View\View;

class Label extends Component
{

    public function __construct(
        public ?string $for = null,
        public ?string $label = null,
        public ?string $model = null,
        public ?string $modifier = null,
        public ?string $icon = null,
        public ?string $tooltip = null,
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
