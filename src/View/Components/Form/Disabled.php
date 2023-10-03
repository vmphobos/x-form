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
            @if($floating) <div class="form-floating"> @endif

            @if(!$floating && $label)
                <x-form.label label="{!! $label !!}" :icon="$icon" />
            @endif
            
            <div class="form-control form-control-alt text-capitalize">{{ $value ?: '-' }}</div>
            
            @if($floating && $label)
                    <x-form.label label="{!! $label !!}" :icon="$icon" />
                </div>
            @endif
        HTML;
    }
}