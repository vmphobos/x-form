<div class="{{ config('x-form.check.wrapper') }}" wire:key="{{ $uuid }}">
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

    <div class="{{ config('x-form.check.wrapper') }}">
        @foreach($list as $category => $items)
            <div class="{{ config('x-form.check.group.column') }}">
                <label
                    class="{{ config('x-form.check.group.label') }}"
                    @if($grouped && $toggle) wire:click="{{ "$toggle('$category')" }}" type="button" @endif
                >
                    {{ Str::headline($category) }}
                </label>

                <div
                    wire:key="{{ $uuid }}"
                    class="{{ config('x-form.check.vertical') }}"
                >
                    @if($total == 0)
                        <div class="{{ config('x-form.check.empty') }}">
                            {{ __('0 :results found', ['results' => $label]) }}
                        </div>
                    @else
                        @foreach ($items as $item)
                            <div class="{{ config('x-form.check.horizontal') }}">
                                <input
                                    type="checkbox" value="{{ $item['id'] }}"
                                    {{
                                        $attributes->class([
                                            config('x-form.check.input'),
                                            config('x-form.invalid') => $errors->has($rule)
                                        ])
                                        ->merge([
                                            'id' => str($name)->slug() . '-' . $item['id'],
                                            'name' => $name,
                                            'wire:model' . $modifier => $model,
                                            'wire:key' => str($name)->slug() . '-' . $item['id'],
                                        ])
                                    }}

                                    @if($modifier)
                                        wire:dirty.class="{{ config('x-form.border') }}"
                                    @endif
                                >

                                <label
                                    for="{{ str($name)->slug() . '-' . $item['id'] }}"
                                    class="{{ config('x-form.check.label') }}"

                                    @if($tooltipKey)
                                        x-tooltip="{{ $item[$tooltipKey] }}"
                                    @endif
                                >
                                    {{ $item['title'] }}
                                </label>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</div>
