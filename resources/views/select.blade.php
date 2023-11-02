<div wire:key="{{ $uuid }}">
    @if($floating)
        <div class="{{ config('x-form.floating') }}">
    @endif

    @if(!$floating && $label)
        <x-form.label for="{{ $uuid }}" label="{!! $label !!}"
            :model="$model" :modifier="$modifier" :icon="$icon" :tooltip="$tooltip" :required="$required"
        />
    @endif

    <select
        {{
            $attributes->class([
                    config('x-form.select'),
                    config('x-form.invalid') => $errors->has($rule)
                ])
                ->merge([
                    'id' => $uuid,
                    'name' => $name,
                    'wire:model' . $modifier => $model,
                    'wire:key' => str($name)->slug(),
                ])
        }}

        @if($modifier)
            wire:dirty.class="{{ config('x-form.border') }}"
        @endif

        @if($tooltip && !$label)
            data-bs-toggle="tooltip" title={{ $tooltip }}
        @endif
    >
        <option>{{ $attributes->get('placeholder') }}</option>

        @foreach($list as $title => $id)
            <option value="{{ $id }}" class="text-capitalize">{{ $title }}</option>
        @endforeach
    </select>

    @if($floating && $label)
        <x-form.label for="{{ $uuid }}" label="{!! $label !!}"
            :model="$model" :modifier="$modifier" :icon="$icon" :tooltip="$tooltip" :required="$required"
        />
    @endif

    @error($rule)
        <div class="{{ config('x-form.error') }}">{{ $message }}</div>
    @enderror
</div>
