<div class="{{ config('x-form.check.wrapper') }}" wire:key="{{ $uuid }}">
    @if($label)
        <div class="w-full">
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
        </div>
    @endif

    @error($rule)
    <div class="{{ config('x-form.error') }}">{!! $message !!}</div>
    @enderror

    @if($total == 0)
        <div class="{{ config('x-form.check.empty') }}">
            {{ __('0 :results found', ['results' => $label]) }}
        </div>
    @else
        @foreach (collect($list)->chunk($itemsPerColumn) as $index => $column)
            <div
                @class([
                    config('x-form.check.group.column') => $vertical,
                    config('x-form.check.group.full') => !$vertical,
                ])
            >
                @foreach ($column as $title => $id)
                    <div class="{{ config('x-form.check.horizontal') }}">
                        <input type="checkbox" value="{{ $id }}"
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
                        >

                        <label class="{{ config('x-form.check.label') }}" for="{{ str($name)->slug() . '-' . $id }}">{{ $title }}</label>
                    </div>
                @endforeach
            </div>
        @endforeach
    @endif
</div>
