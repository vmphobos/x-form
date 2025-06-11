<div wire:key="{{ $uuid }}" class="column-count-md-2 column-count-lg-3 column-gap-md-2">
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

    <div class="row">
        @foreach($list as $category => $items)
            <div class="col-4 mb-5">
                <label class="{{ config('x-form.check.group.label') }}"
                       @if($grouped && $toggle) wire:click="{{ "$toggle('$category')" }}" type="button" @endif
                >
                    {{ Str::headline($category) }}
                </label>

                <div class="{{ config('x-form.check.vertical') }}">
                    <div wire:key="{{ $uuid }}">
                        @if($total == 0)
                            <div class="{{ config('x-form.check.empty') }}">
                                {{ __('0 :results found', ['results' => $label]) }}
                            </div>
                        @else
                            @foreach ($items as $item)
                                <div class="{{ config('x-form.check.div') }}">
                                    <input type="checkbox" value="{{ $item['id'] }}"
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
            </div>
        @endforeach
    </div>
</div>
