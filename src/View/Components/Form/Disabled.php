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
        public ?bool $selectable = false,
        public ?bool $mail = false,
        public ?bool $phone = false,
        public ?bool $fax = false,
        public ?bool $map = false,
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

            <div 
                {{ 
                    $attributes->class([
                        config('x-form.disabled.class'), 
                        'user-select-all' => $selectable && $value
                    ]) 
                }} 
                style="{{ config('x-form.disabled.style') }}"
            >
                {{ $value ?: '-' }}
                @if($value)
                    @if($selectable)
                        <i class="copy-text fa-regular fa-copy float-end mt-1" role="button"></i>
                    @elseif($mail)
                        <a href="mailto:{{ $value }}" class="text-dark float-end"><i class="fa-regular fa-envelope"></i></a>
                    @elseif($phone)
                        <a href="tel:{{ $value }}" class="text-dark float-end"><i class="fa-solid fa-phone-flip"></i></a>
                    @elseif($fax)
                        <a href="fax:{{ $value }}" class="text-dark float-end"><i class="fa-solid fa-fax"></i></a>
                    @elseif($map)
                        <a href="http://maps.google.com/?q={{ $value }}" target="_blank"><i class="fa-solid fa-location-dot"></i></a>
                    @endif
                @endif
            </div>

            @if($floating && $label)
                    <x-form.label label="{!! $label !!}" :icon="$icon" />
                </div>
            @endif
        HTML;
    }
}
