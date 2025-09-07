<div class="row" wire:key="{{ $uuid }}">
    @if($label)
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

    @error($rule)
    <div class="{{ config('x-form.error') }}">{!! $message !!}</div>
    @enderror

    @if($total == 0)
        <div class="{{ config('x-form.check.empty') }}">
            {{ __('0 :results found', ['results' => $label]) }}
        </div>
    @else
        @foreach (collect($list)->chunk($itemsPerColumn) as $column)
            <div
                @class([
                    'truncate col-md-6 col-lg-4 col-xxl-3 mt-2' => $total > 15,
                    config('x-form.check.vertical') => !$horizontal,
                    config('x-form.check.horizontal') => $horizontal
               ])
            >

                @foreach ($column as $title => $id)
                    <div
                        @class([
                            config('x-form.check.div'),
                            config('x-form.check.inline') => $horizontal
                        ])
                    >

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
