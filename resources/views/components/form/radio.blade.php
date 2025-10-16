<div wire:key="{{ $uuid }}">
    @if($label)
        <div class="{{ config('x-form.label') }}">{!! $label !!}</div>
    @endif

    @error($rule)
    <div class="{{ config('x-form.error') }}">{!! $message !!}</div>
    @enderror

    <div
        @class([
            config('x-form.radio.vertical') => !$horizontal,
            config('x-form.radio.horizontal') => $horizontal
        ])
    >
        @foreach ($list as $title => $id)
            <label class="{{ config('x-form.radio.horizontal') }}">
                <input
                    type="radio"
                    value="{{ $id }}"
                    {{
                        $attributes->class([
                            config('x-form.radio.input'),
                            config('x-form.invalid') => $errors->has($rule)
                        ])
                        ->merge([
                            'id' => str($name)->slug() . '-' . $id,
                            'name' => $name,
                            'wire:model' . $modifier => $model,
                            'wire:key' => str($name)->slug() . '-' . $id,
                        ])
                    }}
                />

                <span class="{{ config('x-form.radio.label') }}">{{ $title }}</span>
            </label>
        @endforeach
    </div>
</div>
