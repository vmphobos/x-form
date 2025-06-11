<div wire:key="{{ $uuid }}"
     x-data="{
        limit: {{ $limit }},
        characters() {
            if (this.limit > 0) {
                return this.limit - ($wire.get('{{ $model }}')?.length ?? 0);
            }
            return $wire.get('{{ $model }}')?.length ?? 0;
        }
     }"
>
    @if ($floating)
        <div class="{{ config('x-form.floating') }}">
            @endif

            {{-- Label above textarea (non-floating) --}}
            @if (!$floating && ($label || $attributes->hasSlot('label')))
                @if ($attributes->hasSlot('label'))
                    {{ $slot->label }}
                @else
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
            @endif

            <textarea
                {{
                    $attributes->class([
                        config('x-form.textarea'),
                        config('x-form.invalid') => $errors->has($rule),
                    ])
                    ->merge([
                        'id' => $uuid,
                        'name' => $name,
                        'rows' => $rows,
                        'wire:model' . $modifier => $model,
                        'wire:key' => $uuid,
                    ])
                }}

                @if ($modifier)
                    wire:dirty.class="{{ config('x-form.border') }}"
                @endif

                @if ($tooltip && !$label)
                    x-tooltip="{{ $tooltip }}"
        @endif
    ></textarea>

            @if ($showCount)
                {{-- Show character counter --}}
                <small
                    class="ms-2 float-end"
                    :class="{
                'text-gray-500': characters() >= 0,
                'text-danger': characters() < 0
            }"
                >
                    <span x-text="characters()"></span> characters
                    <span x-show="limit">left</span>
                </small>
            @endif

            {{-- Label below textarea (floating) --}}
            @if ($floating && ($label || $attributes->hasSlot('label')))
                @if ($attributes->hasSlot('label'))
                    {{ $slot->label }}
                @else
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
        </div>
    @endif

    @error($rule)
    <div class="{{ config('x-form.error') }}">{!! $message !!}</div>
    @enderror
</div>
