<?php

namespace Vmphobos\XForm\View\Components\Form;

use Closure;
use Illuminate\Contracts\View\View;

class Select extends FormElement
{
    public function __construct(
        public string $minWidth = 'revert-layer',
        public string $maxHeight = '400px',
        public ?array $list = ['yes' => 1, 'no' => 0],
        public ?string $uuid = null,
        public ?string $name = null,
        public ?string $label = null,
        public ?string $title = null,
        public ?string $icon = null,
        public ?string $model = null,
        public ?string $rule = null,
        public ?string $tooltip = null,
        public ?string $help = null,
        public ?string $confirm = null,
        public ?bool $group = false,
        public ?bool $required = false,
        public ?bool $searchable = false,
        public ?bool $inline = false,
        public bool $live = false,
        public bool $dropdown = true,
    ) {
        parent::__construct();
    }

    public function render(): View|Closure|string
    {
        // If dropdown is true, render the custom dropdown, otherwise render standard select
        return $this->dropdown ? view('x-form::dropdown') : view('x-form::select');
    }
}
