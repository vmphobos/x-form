{{-- Label --}}
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

@if ($group)
    <div
        @class([
            'flex items-center',
            'text-sm' => $group == 'sm',
            'text-lg' => $group == 'lg',
            'text-xl' => $group == 'xl',
        ])
    >
@endif

{{-- Prepend --}}
{{ $prepend }}

<input
    {{
        $attributes->class([
            config('x-form.input'),
            config('x-form.invalid') => $errors->has($rule),
        ])
        ->merge([
            'id' => $uuid,
            'type' => $type,
            'name' => $name,
            'wire:key' => $uuid,
        ])
    }}

    {{-- Wire model conditionally based on live/blur attributes --}}
    @if ($attributes->has('live'))
        wire:model.live="{{ $model }}"
    @elseif ($attributes->has('blur'))
        wire:model.blur="{{ $model }}"
    @else
        wire:model="{{ $model }}"
    @endif

    {{-- Tooltip --}}
    @if ($tooltip && !$label)
        x-tooltip="{{ $tooltip }}"
    @endif

    {{-- Validate condition --}}
    @if ($validate)
        @if ($validate !== 'blur')
            @keyup="validate"
        @else
            @blur="validate"
        @endif
    @endif

/>

{{-- Append --}}
{{ $append }}

@if ($group)
    </div>
@endif

@error($rule)
    <div id="error-{{ $uuid }}" class="{{ config('x-form.error') }}">{!! $message !!}</div>
@enderror
