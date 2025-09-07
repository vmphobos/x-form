<?php
namespace Vmphobos\XForm\View\Components\Form;

use Closure;
use Illuminate\Contracts\View\View;

class Password extends FormElement
{
    public function __construct(
        public string $type = 'password',
        public ?string $uuid = null,
        public ?string $name = null,
        public ?string $label = null,
        public ?string $icon = null,
        public ?string $model = null,
        public ?string $modifier = null,
        public ?string $rule = null,
        public ?string $tooltip = null,
        public ?string $help = null,
        public ?string $group = null,
        public ?bool $floating = false,
        public ?bool $required = false,
        public string|bool $validate = false,
        public ?bool $dirty = false,
    ) {
        if ($this->dirty) {
            $this->modifier ??= 'blur';
        }

        parent::__construct();
    }

    public function render(): View|Closure|string
    {
        return view('x-form::password');
    }
}
