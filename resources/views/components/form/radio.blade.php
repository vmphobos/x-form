<div wire:key="{{ $uuid }}">
    @if ($label)
        <x-form.label
            :for="$uuid"
            :label="$label"
            :model="$model"
            :modifier="$modifier"
            :icon="$icon"
            :tooltip="$tooltip"
            :help="$help"
            :required="$required"
        />
    @endif

    @error($rule)
    <div class="{{ config('x-form.error') }}">{!! $message !!}</div>
    @enderror

    <div
        @class([
            config('x-form.check.vertical') => !$horizontal,  // vertical when false
            config('x-form.check.horizontal') => $horizontal,  // horizontal when true
        ])
    >
        @foreach ($list as $title => $id)
            <div
                @class([
                    config('x-form.check.div'),
                    config('x-form.check.inline') => $horizontal, // inline when horizontal
                ])
            >
                <input
                    type="radio"
                    value="{{ $id }}"
                    {{
                        $attributes->class([
                            config('x-form.check.input'),
                            config('x-form.invalid') => $errors->has($rule),
                        ])
                        ->merge([
                            'id' => str($name)->slug() . '-' . $id,
                            'name' => $name,
                            'wire:model' . $modifier => $model,
                            'wire:key' => str($name)->slug() . '-' . $id,
                        ])
                    }}
                    @if ($modifier)
                        wire:dirty.class="{{ config('x-form.border') }}"
                    @endif
                >

                <label class="{{ config('x-form.check.label') }}" for="{{ str($name)->slug() . '-' . $id }}">{{ $title }}</label>
            </div>
        @endforeach
    </div>
</div>
