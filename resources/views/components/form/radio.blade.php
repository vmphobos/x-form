<div wire:key="{{ $uuid }}">
    @if($label)
        <div class="{{ config('x-form.label') }}">{!! $label !!}</div>
    @endif

    @error($rule)
    <div class="{{ config('x-form.error') }}">{!! $message !!}</div>
    @enderror

    <div
        @class([
            config('x-form.check.vertical') => !$horizontal,
            config('x-form.check.horizontal') => $horizontal
        ])
    >
        @foreach ($list as $title => $id)
            <label class="relative flex items-center cursor-pointer">
                <span class="relative flex items-center w-4 h-4">
                    <input
                        type="radio"
                        value="{{ $id }}"
                        {{
                            $attributes->class([
                                config('x-form.check.input'),
                                config('x-form.invalid') => $errors->has($rule)
                            ])
                            ->merge([
                                'id' => str($name)->slug() . '-' . $id,
                                'name' => $name,
                                'wire:model' . $modifier => $model,
                                'wire:key' => str($name)->slug() . '-' . $id,
                            ])
                        }}
                        @if($modifier)
                            wire:dirty.class="{{ config('x-form.border') }}"
                        @endif
                    />
                </span>

                <span class="{{ config('x-form.check.label') }}">{{ $title }}</span>
            </label>
        @endforeach
    </div>
</div>
