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
            <label class="{{ config('x-form.check.group.label') }}"
                @if($grouped && $toggle) wire:click="{{ $toggle }}('{{ $category }}')" role="button" @endif
            >
                {{ Str::headline($category) }}
            </label>

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
