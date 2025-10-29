<div
    @if($model)
        wire:key="{{ $uuid }}"
    @endif

    x-data="{
        limit: {{ $limit }},
        get model() {
            try {
                return $wire?.get('{{ $model }}') ?? '';
            } catch (e) {
                const el = document.getElementById('{{ $uuid }}');
                return el ? el.value : '';
            }
        },
        characters() {
            if (this.limit > 0) {
                return this.limit - (this.model?.length ?? 0);
            }
            return this.model?.length ?? 0;
        }
     }"
>
    {{-- Label above textarea (non-floating) --}}
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
                'x-on:input' => 'characters()',
            ])
        }}

        @if($model)
            wire:model{{ $modifier }}="{{ $model }}"
            wire:key="{{ $uuid }}"
            @if($modifier)
                wire:dirty.class="{{ config('x-form.border') }}"
            @endif
        @endif

        @if ($tooltip && !$label)
            x-tooltip="{{ $tooltip }}"
        @endif
    ></textarea>

    @if ($showCount)
        {{-- Character counter --}}
        <small
            class="mt-1 ms-2 float-end"
            :class="{
                'text-black/60 dark:text-white/60': characters() >= 0,
                'text-red-500': characters() < 0
            }"
        >
            <span x-text="characters()"></span> characters
            <span x-show="limit">left</span>
        </small>
    @endif

    @error($rule)
        <div class="{{ config('x-form.error') }}">{!! $message !!}</div>
    @enderror
</div>
