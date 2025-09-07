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
                <div class="flex items-center space-x-3">
                    <!-- Checkbox -->
                    <label
                        for="checkbox_{{ $category }}"
                        class="{{ config('x-form.check.group.label') }} flex items-center cursor-pointer"
                        @if($grouped && $toggle) wire:click="{{ "$toggle('$category')" }}" type="button" @endif
                    >
                        <div class="relative">
                            <!-- Hidden checkbox input -->
                            <input type="checkbox" id="checkbox_{{ $category }}" class="hidden peer" />

                            <!-- Custom checkbox container -->
                            <div class="w-6 h-6 border-2 border-gray-400 rounded-lg flex items-center justify-center transition-all peer-checked:bg-blue-500 peer-checked:border-blue-500 peer-checked:ring-2 peer-checked:ring-blue-400 peer-focus:ring-2 peer-focus:ring-blue-400">
                                <!-- Checkmark icon (appears when checked) -->
                                <svg class="w-4 h-4 text-white hidden peer-checked:block" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M16.293 4.293a1 1 0 010 1.414L8 13.414 4.707 10.121a1 1 0 111.414-1.414L8 10.586l7.879-7.879a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </div>
                    </label>

                    <!-- Title Text -->
                    <span class="text-lg font-semibold text-gray-800 hover:text-blue-500 transition-all">{{ Str::headline($category) }}</span>
                </div>

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
