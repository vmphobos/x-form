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
                <div class="relative" x-data="{ show: false }">
                    <input
                        :type="show ? 'text' : 'password'"
                        {{
                            $attributes->class([
                                config('x-form.input'),
                                config('x-form.invalid') => $errors->has($rule),
                                'peer' => $floating,
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

                        {{-- Floating placeholder --}}
                        @if ($floating)
                            placeholder=" "
                        @endif
                    />

                    <button
                        type="button"
                        @click="show = !show"
                        class="absolute inset-y-0 right-0 px-3 flex items-center text-gray-500/80 hover:cursor-pointer hover:text-gray-500 focus:outline-none"
                        tabindex="-1"
                    >
                        <template x-if="!show">
                            <!-- Eye icon (show password) -->
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                                />
                                <path
                                    stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"
                                />
                            </svg>
                        </template>
                        <template x-if="show">
                            <!-- Eye off icon (hide password) -->
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13.875 18.825A10.05 10.05 0 0112 19c-4.477 0-8.268-2.943-9.542-7a9.965 9.965 0 012.073-3.39M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                                />
                                <path
                                    stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 3l18 18"
                                />
                            </svg>
                        </template>
                    </button>
                </div>

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
