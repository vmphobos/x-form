<?php

namespace Vmphobos\XForm\View\Components\Form;

use Closure;
use Illuminate\Contracts\View\View;

class Textarea extends FormElement
{
    public function __construct(
        public ?int $rows = 5,
        public ?string $name = null,
        public ?string $label = null,
        public ?string $icon = null,
        public ?string $model = null,
        public ?string $rule = null,
        public ?string $tooltip = null,
        public ?string $help = null,
        public int $limit = 0,
        public bool $showCount = true,
        public bool $required = false,
    ) {
        // Normalize the boolean required flag
        $this->required = (bool) $required;

        parent::__construct();
    }

    /**
     * Render the textarea component.
     *
     * @return View|Closure|string
     */
    public function render(): View|Closure|string
    {
        return view('x-form::textarea');
    }
}
