<?php

namespace Vmphobos\XForm\View\Components\Form;

use Closure;
use Illuminate\Contracts\View\View;

class Textarea extends FormElement
{
    /**
     * Textarea component constructor.
     *
     * @param int|null $rows
     * @param string|null $name
     * @param string|null $label
     * @param string|null $icon
     * @param string|null $model
     * @param string|null $rule
     * @param string|null $tooltip
     * @param string|null $help
     * @param int $limit
     * @param bool $showCount
     * @param bool $floating
     * @param bool $required
     * @param bool $dirty
     */
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
        public bool $floating = false,
        public bool $required = false,
        public bool $dirty = false,
    ) {
        // Handle modifier for dirty state
        if ($this->dirty) {
            $this->modifier ??= 'blur';
        }

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
