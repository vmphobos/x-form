<?php

namespace App\View\Components\Form;

use Closure;
use Illuminate\Contracts\View\View;

class Checkbox extends FormElement
{
    public string $uuid;

    public function __construct(
        public ?array $list = ['yes' => 1, 'no' => 0],
        public ?int $itemsPerColumn = 15,
        public ?int $total = 0,
        public ?string $name = null,
        public ?string $label = null,
        public ?string $icon = null,
        public ?string $model = null,
        public ?string $modifier = null,
        public ?string $rule = null,
        public ?string $tooltip = null,
        public ?string $tooltipKey = null,
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
             return view('components.form.checkbox-group');
        }

         return view('components.form.checkbox');
    }
}
