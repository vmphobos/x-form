<?php

namespace Vmphobos\XForm\View\Components\Form;

use Closure;
use Illuminate\Contracts\View\View;

class Radio extends FormElement
{
    /**
     * Radio component constructor.
     *
     * @param  array|null  $list
     * @param  string|null  $name
     * @param  string|null  $label
     * @param  string|null  $icon
     * @param  string|null  $model
     * @param  string|null  $modifier
     * @param  string|null  $rule
     * @param  string|null  $tooltip
     * @param  string|null  $help
     * @param  bool|null  $required
     * @param  bool|null  $horizontal
     */
    public function __construct(
        public ?array $list = null,
        public ?string $name = null,
        public ?string $label = null,
        public ?string $icon = null,
        public ?string $model = null,
        public ?string $modifier = null,
        public ?string $rule = null,
        public ?string $tooltip = null,
        public ?string $help = null,
        public ?bool $required = false,
        public ?bool $horizontal = false,
    ) {
        // Normalize required flag (convert to boolean)
        $this->required = (bool) $required;

        $this->list ??= [__('Yes') => 1, __('No') => 0];

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
