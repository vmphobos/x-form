<?php

namespace XForm\View\Components\Form;

use Closure;
use Illuminate\View\Component;
use Illuminate\View\View;

class Label extends Component
{

    public function __construct(
        public ?string $for = null,
        public ?string $label = null,
        public ?string $model = null,
        public ?string $modifier = null,
        public ?string $icon = null,
        public ?string $tooltip = null,
        public ?bool $required = false
    )
    {
        //...
    }

    public function render(): View|Closure|string
    {
        return <<<'HTML'
            <label for="{{ $for }}"
                @if($modifier && $model) wire:target="{{ $model }}" @endif

                @class([
                    config('x-form.label'),
                    config('x-form.required') => $required
                ])
                @if($tooltip)
                    data-bs-toggle="tooltip"title="{{ $tooltip }}"
                @endif
            >
                @if($icon)
                    <i class="{{ $icon }}"
                       @if($modifier && $model) wire:loading.remove wire:target="{{ $model }}" @endif
                    ></i>
                @endif

                @if($modifier && $model)
                    <span wire:loading wire:target="{{ $model }}" class="{{ config('x-form.spinner') }}"></span>
                @endif

                {!! $label !!}
            </label>
        HTML;
    }
}
