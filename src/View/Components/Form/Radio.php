<?php

namespace XForm\View\Components\Form;

use Closure;
use Illuminate\Contracts\View\View;

class Radio extends FormElement
{
    public string $uuid;

    public function __construct(
        public ?array $list = ['yes' => 1, 'no' => 0],
        public ?string $name = null,
        public ?string $label = null,
        public ?string $icon = null,
        public ?string $model = null,
        public ?string $modifier = null,
        public ?string $rule = null,
        public ?string $tooltip = null,
        public ?bool $required = false,
        public ?bool $horizontal = false,
        public ?bool $dirty = false,
    ) {
        if($this->dirty) {
            $this->modifier ??= 'live';
        }

        parent::__construct();

        $this->uuid = md5(json_encode($this));
    }

    public function render(): View|Closure|string
    {
        return <<<'HTML'
            <div wire:key="{{ $uuid }}">
                @if($label)
                    <x-form.label for="{{ $uuid }}" label="{!! $label !!}"
                        :model="$model" :modifier="$modifier" :icon="$icon" :tooltip="$tooltip" :required="$required"
                    />
                @endif

                @error($rule)
                    <div class="{{ config('x-form.error') }}">{{ $message }}</div>
                @enderror

                <div
                    @class([
                        config('x-form.check.vertical') => !$horizontal,
                        config('x-form.check.horizontal') => $horizontal
                    ])
                >
                    @foreach($list as $title => $id)
                        <div
                            @class([
                                config('x-form.check.div'),
                                config('x-form.check.inline') => $horizontal
                            ])
                        >
                            <input type="radio" value="{{ $id }}"
                                {{
                                    $attributes->class([
                                        config('x-form.check.input'),
                                        config('x-form.invalid') => $errors->has($rule)
                                    ])
                                    ->merge([
                                        'id' => str($name)->slug() . '_' . $id,
                                        'name' => $name,
                                        'wire:model' . $modifier => $model,
                                        'wire:key' => str($name)->slug() . '_' . $id,
                                    ])
                                }}

                                @if($modifier)
                                    wire:dirty.class="{{ config('x-form.border') }}"
                                @endif
                            >

                            <label class="{{ config('x-form.check.label') }}" for="{{ str($name)->slug() . '_' . $id }}">{{ $title }}</label>
                        </div>
                    @endforeach
                </div>
            </div>
        HTML;
    }
}
