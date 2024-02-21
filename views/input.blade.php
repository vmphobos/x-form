@if($floating)
    <div class="{{ config('x-form.floating') }}">
@endif

@if(!$floating && $label)
    <x-form.label for="{{ $uuid }}" label="{!! $label !!}"
        :model="$model" :modifier="$modifier" :icon="$icon" :tooltip="$tooltip" :required="$required"
    />
@endif

{{ $prepend }}

<input
    {{
        $attributes->class([
            config('x-form.input'),
            config('x-form.invalid') => $errors->has($rule)
        ])
        ->merge([
            'id' => $uuid,
            'type' => $type,
            'name' => $name,
            'wire:model' . $modifier => $model,
            'wire:key' => $uuid,
        ])
    }}

    @if($modifier)
        wire:dirty.class="{{ config('x-form.border') }}"
    @endif

    @if($tooltip && !$label)
        data-bs-toggle="tooltip" title={{ $tooltip }}
    @endif
/>

{{ $append }}

@if($floating && $label)
    <x-form.label for="{{ $uuid }}" label="{!! $label !!}"
        :model="$model" :modifier="$modifier" :icon="$icon" :tooltip="$tooltip" :required="$required"
    />
    </div>
@endif

@error($rule)
    <div class="{{ config('x-form.error') }}">{{ $message }}</div>
@enderror
