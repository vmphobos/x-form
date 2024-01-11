<?php

namespace XForm\View\Components\Form;

use Closure;
use Illuminate\Contracts\View\View;

class Checkbox extends FormElement
{
    public function __construct(
        public ?array $list = ['yes' => 1, 'no' => 0],
        public ?int $itemsPerColumn = 15,
        public ?int $total = 0,
        public ?string $uuid = '',
        public ?string $name = '',
        public ?string $label = '',
        public ?string $icon = '',
        public ?string $model = '',
        public ?string $modifier = '',
        public ?string $rule = '',
        public ?string $tooltip = '',
        public ?string $tooltipKey = '',
        public ?string $toggle = '',
        public ?bool $required = false,
        public ?bool $horizontal = false,
        public ?bool $grouped = false,
        public ?bool $dirty = false,
    ) {
        $this->total = count($this->list);

        if($this->dirty) {
            $this->modifier ??= 'live';
        }

        parent::__construct();

        $this->uuid = md5(json_encode($this));
    }

    public function render(): View|Closure|string
    {
        if($this->grouped) {
             return view('x-form::checkbox-group');
        }

         return view('x-form::checkbox');
    }
}
