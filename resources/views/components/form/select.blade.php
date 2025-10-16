<div wire:key="{{ $uuid }}">
    @if ($group)
        <div class="input-group">
    @endif

    {{ $prepend }}



    @if ($label)
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

    <select
        {{
            $attributes->class([
                config('x-form.dropdown.input'),
                config('x-form.invalid') => $errors->has($rule)
            ])->merge([
                'id' => $uuid,
                'name' => $name,
                'wire:model' . $modifier => $model,
                'wire:key' => str($name)->slug(),
            ])
        }}

        @if ($tooltip && !$label)
            x-tooltip="{{ $tooltip }}"
        @endif

        @if ($required)
            @change="validate"
        @endif
    >
        {{-- Placeholder Option --}}
        <option value="" disabled selected>{{ $attributes->get('placeholder') ?? 'Select an option' }}</option>

        {{-- Loop through the options --}}
        @foreach ($list as $title => $id)
            <option value="{{ $id }}" wire:key="{{ str($name)->slug() . '-' . $id }}">{{ $title }}</option>
        @endforeach
    </select>

    {{ $append }}

    @if ($group)
        </div>
    @endif

    {{-- Display Validation Errors --}}
    @error($rule)
        <div class="{{ config('x-form.error') }}">{!! $message !!}</div>
    @enderror
</div>
