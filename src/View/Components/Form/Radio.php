<?php

namespace XForm\View\Components\Form;

use Closure;
use Illuminate\Contracts\View\View;

class RadioButton extends FormElement
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
                    @danger({{ $message }})
                @enderror
            
                <div
                    @class([
                        'space-y-2',
                        'space-x-2' => count($list) < 4
                    ])
                >
                    @foreach($list as $title => $id)
                        <div
                            @class([
                                'form-check',
                                'form-check-inline' => count($list) < 4
                            ])
                        >
                            <input type="radio" value="{{ $id }}"
                                {{
                                    $attributes->class([
                                        'form-check-input shadow-none',
                                        'is-invalid' => $errors->has($rule)
                                    ])
                                    ->merge([
                                        'id' => str($name)->slug() . '_' . $id,
                                        'name' => $name,
                                        'wire:model' . $modifier => $model,
                                        'wire:key' => str($name)->slug() . '_' . $id,
                                    ])
                                }}
            
                                @if($modifier)
                                    wire:dirty.class="border-warning"
                                @endif
                            >
            
                            <label class="form-check-label text-capitalize" for="{{ str($name)->slug() . '_' . $id }}">{{ $title }}</label>
                        </div>
                    @endforeach
                </div>
            </div>
        HTML;

    }
}
