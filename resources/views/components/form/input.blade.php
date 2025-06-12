{{-- Label --}}
@if (!$floating && $label)
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

        @if ($floating && $label)
            <div class="{{ config('x-form.floating') }}">
                @endif

                <input
                    {{
                        $attributes->class([
                            config('x-form.input'),
                            config('x-form.invalid') => $errors->has($rule),
                            'peer' => $floating,
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

                    {{-- Floating placeholder --}}
                    @if ($floating)
                        placeholder=" "
                    @endif
                />

                @if ($floating && $label)
                    <x-form.label
                        class="absolute rounded-md text-sm text-dark-500 dark:text-dark-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-dark-950 px-2 peer-autofill:bg-white dark:peer-autofill:bg-dark-950 peer-focus:px-2 peer-focus:text-primary-600 dark:peer-focus:text-primary-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 peer-focus:rtl:translate-x-1/4 peer-focus:rtl:left-auto start-1"
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

                {{-- Append --}}
                {{ $append }}

                @if ($group)
            </div>
        @endif

        @error($rule)
        <div id="error-{{ $uuid }}" class="{{ config('x-form.error') }}">{!! $message !!}</div>
    @enderror
