<div wire:key="{{ $uuid }}">
    @if($label)
        <x-form.label
            :for="$uuid"
            :label="$label"
            :model="$model"
            :modifier="$attributes->has('live') || $attributes->has('blur')"
            :icon="$icon"
            :tooltip="$tooltip"
            :help="$help"
            :required="$required"
        />
    @endif

    @error($rule)
        <div class="{{ config('x-form.error') }}">{!! $message !!}</div>
    @enderror

    @if($total == 0)
        <div class="{{ config('x-form.checkbox.empty') }}">
            {{ __('0 :results found', ['results' => $label]) }}
        </div>
    @else

        <div
            @class([
                $layout  => !$horizontal,
          ])
        >
            @foreach (collect($list)->chunk($perColumn) as $column)
                <div
                    @class([
                        'w-full',
                        config('x-form.checkbox.horizontal') => $horizontal,
                        config('x-form.checkbox.vertical') => !$horizontal,
                   ])
                >
                    @foreach ($column as $title => $id)
                        <div
                            @class([
                                config('x-form.checkbox.div'),
                            ])
                        >
                            <input
                                type="checkbox" value="{{ $id }}"
                                {{
                                    $attributes->class([
                                        config('x-form.checkbox.input'),
                                        config('x-form.invalid') => $errors->has($rule)
                                    ])
                                    ->merge([
                                        'id' => str($name)->slug() . '-' . $id,
                                        'name' => $name,
                                        'wire:model' . $modifier => $model,
                                        'wire:key' => str($name)->slug() . '-' . $id,
                                    ])
                                }}
                            >

                            <label
                                for="{{ str($name)->slug() . '-' . $id }}"
                                class="{{ config('x-form.checkbox.label') }}"

                                @if($tooltipKey)
                                    x-tooltip="{{ $item[$tooltipKey] }}"
                                @endif
                            >
                               {!! config('x-form.checkbox.icon') !!}
                            </label>
                            <span class="{{ config('x-form.checkbox.title') }}">
                                {{ $title }}
                            </span>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>

    @endif
</div>
