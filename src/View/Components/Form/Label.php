<?php

namespace Vmphobos\XForm\View\Components\Form;

use Closure;
use Illuminate\View\Component;
use Illuminate\View\View;

class Label extends Component
{
    /**
     * @param  string|null  $for  The id the label is for
     * @param  string|null  $label  The label text (can contain HTML)
     * @param  string|null  $model  Livewire model target
     * @param  string|null  $modifier  Livewire modifier like '.lazy', '.debounce'
     * @param  string|null  $icon  Icon CSS classes to show beside label
     * @param  string|null  $help  Help text for popover
     * @param  string|null  $tooltip  Tooltip text
     * @param  bool  $required  Whether the label marks a required field
     */
    public function __construct(
        public ?string $for = null,
        public ?string $label = null,
        public ?string $model = null,
        public ?string $modifier = null,
        public ?string $icon = null,
        public ?string $help = null,
        public ?string $tooltip = null,
        public bool $required = false
    ) {
        // Ensure $required is boolean
        $this->required = (bool) $required;
    }

    public function render(): View|Closure|string
    {
        return view('x-form::label');
    }
}
