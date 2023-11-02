<?php

namespace XForm\View\Components\Form;

use Closure;
use Illuminate\Contracts\View\View;

class Input extends FormElement
{
    public string $uuid;

    public function __construct(
        public string $type = 'text',
        public ?string $name = null,
        public ?string $label = null,
        public ?string $icon = null,
        public ?string $model = null,
        public ?string $modifier = null,
        public ?string $rule = null,
        public ?string $tooltip = null,
        public ?bool $floating = false,
        public ?bool $required = false,
        public ?bool $dirty = false,
    ) {
        if($this->dirty) {
            $this->modifier ??= 'blur';
        }

        parent::__construct();

        $this->uuid = md5(json_encode($this));
    }

    public function render(): View|Closure|string
    {
        return view('x-form::input');
    }
}
