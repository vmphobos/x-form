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

<div class="relative" x-data="{ show: false }">
    <input
        :type="show ? 'text' : 'password'"
        {{
            $attributes->class([
                config('x-form.input'),
                config('x-form.invalid') => $errors->has($rule),
            ])
            ->merge([
                'id' => $uuid,
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

    <button
        type="button"
        @click="show = !show"
        class="absolute inset-y-0 right-0 px-3 flex items-center focus:outline-none text-black/30 hover:text-black/50 dark:text-white/30 dark:hover:text-white/50 hover:cursor-pointer"
        tabindex="-1"
    >
        <template x-if="!show">
            <!-- Eye icon (show password) -->
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="size-5 lucide lucide-eye-icon lucide-eye"><path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0"/><circle cx="12" cy="12" r="3"/></svg>
        </template>
        <template x-if="show">
            <!-- Eye off icon (hide password) -->
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="size-5 lucide lucide-eye-off-icon lucide-eye-off"><path d="M10.733 5.076a10.744 10.744 0 0 1 11.205 6.575 1 1 0 0 1 0 .696 10.747 10.747 0 0 1-1.444 2.49"/><path d="M14.084 14.158a3 3 0 0 1-4.242-4.242"/><path d="M17.479 17.499a10.75 10.75 0 0 1-15.417-5.151 1 1 0 0 1 0-.696 10.75 10.75 0 0 1 4.446-5.143"/><path d="m2 2 20 20"/></svg>
        </template>
    </button>
</div>

{{-- Append --}}
{{ $append }}

@if ($group)
    </div>
@endif

@error($rule)
    <div id="error-{{ $uuid }}" class="{{ config('x-form.error') }}">{!! $message !!}</div>
@enderror
