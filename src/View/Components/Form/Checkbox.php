<?php

namespace XForm\View\Components\Form;

use Closure;
use Illuminate\Contracts\View\View;

class Checkbox extends FormElement
{
    public string $uuid;

    public function __construct(
        public ?array $list = ['yes' => 1, 'no' => 0],
        public ?int $itemsPerColumn = 15,
        public ?int $total = 0,
        public ?string $name = null,
        public ?string $label = null,
        public ?string $icon = null,
        public ?string $model = null,
        public ?string $modifier = null,
        public ?string $rule = null,
        public ?string $tooltip = null,
        public ?string $tooltipKey = null,
        public ?bool $required = false,
        public ?bool $horizontal = false,
        public ?bool $grouped = false,
        public ?bool $dirty = false,
    ) {
        $this->total = count($this->list);

        if($this->dirty) {
            $this->modifier ??= 'live';
        }

        parent::__construct();

        $this->uuid = md5(json_encode($this));
    }

    public function render(): View|Closure|string
    {
        if($this->grouped) {
            return <<<'HTML'
                <div wire:key="{{ $uuid }}" class="column-count-md-2 column-count-lg-3 column-gap-md-2">
                    @if($label)
                        <x-form.label for="{{ $uuid }}" label="{!! $label !!}"
                            :model="$model" :modifier="$modifier" :icon="$icon" :tooltip="$tooltip" :required="$required"
                        />
                    @endif

                    @error($rule)
                        <div class="{{ config('x-form.error') }}">{{ $message }}</div>
                    @enderror

                    @foreach($list as $category => $items)
                        <div class="{{ config('x-form.check.group.div') }}">
                            <label class="{{ config('x-form.check.group.label') }}">{{ Str::headline($category) }}</label>

                            <div class="{{ config('x-form.check.vertical') }}">
                                <div wire:key="{{ $uuid }}">
                                    @if($total == 0)
                                        <div class="{{ config('x-form.check.empty') }}">
                                            {{ __('0 :results found', ['results' => $label]) }}
                                        </div>
                                    @else
                                        @foreach($items as $item)
                                        <div class="{{ config('x-form.check.div') }}">
                                            <input type="checkbox" value="{{ $item['id'] }}"
                                                {{
                                                    $attributes->class([
                                                        config('x-form.check.input'),
                                                        config('x-form.invalid') => $errors->has($rule)
                                                    ])
                                                    ->merge([
                                                        'id' => str($name)->slug() . '_' . $item['id'],
                                                        'name' => $name,
                                                        'wire:model' . $modifier => $model,
                                                        'wire:key' => str($name)->slug() . '_' . $item['id'],
                                                    ])
                                                }}

                                                @if($modifier)
                                                    wire:dirty.class="{{ config('x-form.border') }}"
                                                @endif
                                            >

                                            <label for="{{ str($name)->slug() . '_' . $item['id'] }}"
                                                   class="{{ config('x-form.check.label') }}"

                                                   @if($tooltipKey)
                                                       title="{{ $item[$tooltipKey] }}"--}}
                                                       data-bs-toggle="tooltip"
                                                   @endif
                                            >
                                                {{ $item['title'] }}
                                            </label>
                                        </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            HTML;
        }

        return <<<'HTML'
            <div class="row" wire:key="{{ $uuid }}">
                @if($label)
                    <x-form.label for="{{ $uuid }}" label="{!! $label !!}"
                        :model="$model" :modifier="$modifier" :icon="$icon" :tooltip="$tooltip" :required="$required"
                    />
                @endif

                @error($rule)
                    <div class="{{ config('x-form.error') }}">{{ $message }}</div>
                @enderror

                @if($total == 0)
                    <div class="{{ config('x-form.check.empty') }}">
                        {{ __('0 :results found', ['results' => $label]) }}
                    </div>
                @else
                    @foreach(collect($list)->chunk($itemsPerColumn) as $column)
                        <div
                            @class([
                                'col-md-6 col-lg-4 col-xxl-3 mt-2' => $total > 15,
                                config('x-form.check.vertical') => !$horizontal,
                                config('x-form.check.horizontal') => $horizontal
                           ])
                        >

                        @foreach($column as $title => $id)
                            <div
                                @class([
                                    config('x-form.check.div'),
                                    config('x-form.check.inline') => $horizontal
                                ])
                            >

                                <input type="checkbox" value="{{ $id }}"
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
                    @endforeach
                @endif
            </div>
        HTML;
    }
}
