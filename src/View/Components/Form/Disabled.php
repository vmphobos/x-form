<?php

namespace XForm\View\Components\Form;

use Closure;
use Illuminate\View\Component;
use Illuminate\View\View;

class Disabled extends Component
{
    public function __construct(
        public ?string $label = null,
        public ?string $value = null,
        public ?string $floating = null,
        public ?string $icon = null,
        public ?string $tooltip = null,
    )
    {
        /**
         *  SO DISABLED
         */
    }

    public function render(): View|Closure|string
    {
        return <<<'HTML'
            @if($floating) <div class="{{ config('x-form.floating') }}"> @endif

            @if(!$floating && $label)
                <x-form.label label="{!! $label !!}" :icon="$icon" />
            @endif

            <div class="{{ config('x-form.disabled.class') }}" style="{{ config('x-form.disabled.style') }}">{{ $value ?: '-' }}</div>

            @if($floating && $label)
                    <x-form.label label="{!! $label !!}" :icon="$icon" />
                </div>
            @endif
        HTML;
    }
}
