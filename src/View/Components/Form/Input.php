<?php

namespace XForm\View\Components\Form;

use Closure;
use Illuminate\Contracts\View\View;

class Input extends FormElement
{
    public string $uuid;

    public function __construct(
        public string $type = 'text',
        public ?string $name = null,
        public ?string $label = null,
        public ?string $icon = null,
        public ?string $model = null,
        public ?string $modifier = null,
        public ?string $rule = null,
        public ?string $tooltip = null,
        public ?bool $floating = false,
        public ?bool $required = false,
        public ?bool $dirty = false,
    ) {
        if($this->dirty) {
            $this->modifier ??= 'blur';
        }

        parent::__construct();

        $this->uuid = md5(json_encode($this));
    }

    public function render(): View|Closure|string
    {
        return <<<'HTML'
            @if($floating)
                <div class="{{ config('x-form.floating') }}">
            @endif

            @if(!$floating && $label)
                <x-form.label for="{{ $uuid }}" label="{!! $label !!}"
                    :model="$model" :modifier="$modifier" :icon="$icon" :tooltip="$tooltip" :required="$required"
                />
            @endif

            <input
                {{
                    $attributes->class([
                            config('x-form.input'),
                            config('x-form.invalid') => $errors->has($rule)
                        ])
                        ->merge([
                            'id' => $uuid,
                            'type' => $type,
                            'name' => $name,
                            'wire:model' . $modifier => $model,
                            'wire:key' => str($name)->slug(),
                        ])
                }}

                @if($modifier)
                    wire:dirty.class="{{ config('x-form.border') }}"
                @endif

                @if($tooltip && !$label)
                    data-bs-toggle="tooltip" title={{ $tooltip }}
                @endif
            />

            @if($floating && $label)
                <x-form.label for="{{ $uuid }}" label="{!! $label !!}"
                    :model="$model" :modifier="$modifier" :icon="$icon" :tooltip="$tooltip" :required="$required"
                />
                </div>
            @endif

            @error($rule)
                <div class="{{ config('x-form.error') }}">{{ $message }}</div>
            @enderror
        HTML;
    }
}
