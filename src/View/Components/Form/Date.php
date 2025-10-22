<?php

namespace Vmphobos\XForm\View\Components\Form;

use Closure;
use Illuminate\Contracts\View\View;

class Date extends FormElement
{
    public function __construct(
        public ?string $label = null,
        public ?string $model = null,
        public ?string $placeholder = null,
        public ?string $icon = null,
        public ?string $type = 'date',
        public ?bool $required = false,
        public ?string $tooltip = null,
        public ?string $help = null,
        public ?string $rule = null,
        public ?bool $group = false,
    ) {
        parent::__construct();
    }

    public function render(): View|Closure|string
    {
        return view('x-form::date');
    }
}
