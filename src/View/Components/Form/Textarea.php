<?php

namespace XForm\View\Components\Form;

use Closure;
use Illuminate\Contracts\View\View;

class Textarea extends FormElement
{
    public function __construct(
        public ?int $rows = 5,
        public ?string $uuid = '',
        public ?string $name = '',
        public ?string $label = '',
        public ?string $icon = '',
        public ?string $model = '',
        public ?string $modifier = '',
        public ?string $rule = '',
        public ?string $tooltip = '',
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
