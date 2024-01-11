<?php

namespace XForm\View\Components\Form;

use Closure;
use Illuminate\Contracts\View\View;

class Textarea extends FormElement
{
    public function __construct(
        public ?int $rows = 5,
        public ?string $uuid = null,
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
        return view('x-form::textarea');
    }
}
