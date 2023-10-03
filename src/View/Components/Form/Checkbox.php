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
                        @danger({{ $message }})
                    @enderror
                
                    @foreach($list as $category => $items)
                        <div class="d-inline-block w-100">
                            <label class="mt-3 fw-bold">{{ Str::headline($category) }}</label>
                
                            <div class="space-y-2">
                                <div wire:key="{{ $uuid }}">
                                    @if($total == 0)
                                        <div class="text-capitalize text-muted">
                                            {{ __('0 :results found', ['results' => $label]) }}
                                        </div>
                                    @else
                                        @foreach($items as $item)
                                        <div class="form-check">
                                            <input type="checkbox" value="{{ $item['id'] }}"
                                                {{
                                                    $attributes->class([
                                                        'form-check-input shadow-none',
                                                        'is-invalid' => $errors->has($rule)
                                                    ])
                                                    ->merge([
                                                        'id' => str($name)->slug() . '_' . $item['id'],
                                                        'name' => $name,
                                                        'wire:model' . $modifier => $model,
                                                        'wire:key' => str($name)->slug() . '_' . $item['id'],
                                                    ])
                                                }}
                
                                                @if($modifier)
                                                    wire:dirty.class="border-warning"
                                                @endif
                                            >
                
                                            <label for="{{ str($name)->slug() . '_' . $item['id'] }}"
                                                   class="form-check-label text-capitalize"
                
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
                    @danger({{ $message }})
                @enderror
            
                @if($total == 0)
                    <div class="text-capitalize text-muted">
                        {{ __('0 :results found', ['results' => $label]) }}
                    </div>
                @else
                    @foreach(collect($list)->chunk($itemsPerColumn) as $column)
                        <div
                            @class([
                                'col-md-6 col-lg-4 col-xxl-3 mt-2' => $total > 15,
                                'space-y-2' => !$horizontal,
                                'space-x-2' => $horizontal
                           ])
                        >
            
                        @foreach($column as $title => $id)
                            <div
                                @class([
                                    'form-check',
                                    'form-check-inline' => $horizontal
                                ])
                            >
            
                                <input type="checkbox" value="{{ $id }}"
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
                    @endforeach
                @endif
            </div>
        HTML;

    }
}