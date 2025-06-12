<?php

namespace Vmphobos\XForm\View\Components\Form;

use Closure;
use Illuminate\Contracts\View\View;

class Input extends FormElement
{
    public function __construct(
        public ?string $label = null,
        public ?string $model = null,
        public ?string $placeholder = null,
        public ?string $icon = null,
        public ?string $type = 'text',
        public ?bool $floating = false,
        public ?bool $required = false,
        public ?string $tooltip = null,
        public ?string $help = null,
        public ?string $rule = null,
        public bool $invalid = false,
        public bool $border = true,
        public ?bool $group = false,
        public ?bool $dirty = false,
        public string|bool $validate = false,
    ) {
        parent::__construct();
    }

    public function render(): View|Closure|string
    {
        return view('x-form::input');
    }
}
