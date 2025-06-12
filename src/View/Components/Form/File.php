<?php

namespace Vmphobos\XForm\View\Components\Form;

use Closure;
use Illuminate\Contracts\View\View;

class File extends FormElement
{
    public function __construct(
        public ?string $uuid = null,
        public ?string $name = null,
        public ?string $label = null,
        public ?string $icon = null,
        public ?string $svg = null,
        public ?string $model = null,
        public ?string $modifier = null,
        public ?string $multiple = null,
        public ?string $rule = null,
        public ?string $tooltip = null,
        public ?string $help = null,
        public ?bool $dropzone = false,
        public ?bool $required = false,
    ) {
        if ($multiple) {
            $this->multiple = 'multiple';
        }
        parent::__construct();
    }

    public function render(): View|Closure|string
    {
        return view('x-form::file');
    }
}
