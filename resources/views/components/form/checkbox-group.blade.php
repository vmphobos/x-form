<div wire:key="{{ $uuid }}">
    @if($label)
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

    @error($rule)
        <div class="{{ config('x-form.error') }}">{!! $message !!}</div>
    @enderror

    <div
        @class([
            'w-full',
            config('x-form.checkbox.horizontal') => $horizontal,
            config('x-form.checkbox.vertical') => !$horizontal,
       ])
    >
        @foreach($list as $category => $items)
            <div class="w-full mb-5">
                <button type="button" class="{{ config('x-form.checkbox.group.label') }}"
                        @if($grouped && $toggle) wire:click="{{ "$toggle('$category')" }}" type="button" x-tooltip="{{ __('Select All') }}" @endif
                >
                    {{ Str::headline($category) }}
                </button>

                <div class="{{ config('x-form.checkbox.vertical') }}">
                    <div wire:key="{{ $uuid }}">
                        @if($total == 0)
                            <div class="{{ config('x-form.checkbox.empty') }}">
                                {{ __('0 :results found', ['results' => $label]) }}
                            </div>
                        @else
                            @foreach ($items as $item)
                                <div class="{{ config('x-form.checkbox.div') }}">
                                    <input type="checkbox" value="{{ $item['id'] }}"
                                       {{
                                           $attributes->class([
                                               config('x-form.checkbox.input'),
                                               config('x-form.invalid') => $errors->has($rule)
                                           ])
                                           ->merge([
                                               'id' => str($name)->slug() . '-' . $item['id'],
                                               'name' => $name,
                                               'wire:model' . $modifier => $model,
                                               'wire:key' => str($name)->slug() . '-' . $item['id'],
                                           ])
                                       }}
                                    >

                                    <label
                                        for="{{ str($name)->slug() . '-' . $item['id'] }}"
                                        class="{{ config('x-form.checkbox.label') }}"

                                        @if($tooltipKey)
                                            x-tooltip="{{ $item[$tooltipKey] }}"
                                        @endif
                                    >
                                        {!! config('x-form.checkbox.icon') !!}
                                    </label>
                                    <span class="{{ config('x-form.checkbox.title') }}">{{ $item['title'] }}</span>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
