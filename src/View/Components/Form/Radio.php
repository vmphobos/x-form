<?php

namespace Vmphobos\XForm\View\Components\Form;

use Closure;
use Illuminate\Contracts\View\View;

class Radio extends FormElement
{
    /**
     * Radio component constructor.
     *
     * @param array|null $list
     * @param string|null $uuid
     * @param string|null $name
     * @param string|null $label
     * @param string|null $icon
     * @param string|null $model
     * @param string|null $modifier
     * @param string|null $rule
     * @param string|null $tooltip
     * @param string|null $help
     * @param bool|null $required
     * @param bool|null $vertical
     * @param bool|null $dirty
     */
    public function __construct(
        public ?array $list = ['yes' => 1, 'no' => 0],
        public ?string $name = null,
        public ?string $label = null,
        public ?string $icon = null,
        public ?string $model = null,
        public ?string $modifier = null,
        public ?string $rule = null,
        public ?string $tooltip = null,
        public ?string $help = null,
        public ?bool $required = false,
        public ?bool $vertical = true,
        public ?bool $dirty = false,
    ) {
        // Handle modifier for dirty state
        if ($this->dirty) {
            $this->modifier ??= 'change';
        }

        // Normalize required flag (convert to boolean)
        $this->required = (bool) $required;

        parent::__construct();
    }

    /**
     * Render the radio component.
     *
     * @return View|Closure|string
     */
    public function render(): View|Closure|string
    {
        return view('x-form::radio');
    }
}
