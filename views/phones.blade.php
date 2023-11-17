<div wire:key="{{ $uuid }}" class="row">

    @foreach($phone_types as $type => $type_icon)

        @for($i=0; $i < $$type;)

            <div class="col-md-6 col-xxl-3 mt-4">
            @php
                $i++;
                $label = $for = $phone_name = $type;

                if($$type > 1) {
                    $label .= ' ' . $i;
                }

                $for = "{$type}_{$i}";
                $phone_name = "{$type}_{$i}";

                $phone_country = "{$phone_name}_country";
            @endphp


            @if($floating)
                <div class="{{ config('x-form.floating') }}">
            @endif

            @if(!$floating && $label)
                <x-form.label
                    for="{{ $for }}" label="{!! $label !!}"
                    :model="$phone_country" :modifier="$modifier" :icon="$icon" :tooltip="$tooltip" :required="$required"
                />
            @endif

            <div class="input-group" wire:ignore>
                {{-- selected button --}}
                <button type="button" class="btn btn-alt-secondary text-capitalize country-prefix-label" style="font-size: .9rem;">
                    @if(!str($model)->contains('.'))
                        <i @class([
                                $type_icon => !Arr::get($this->$array_name, $phone_country),
                                'flag ' . strtolower(Arr::get($this->$array_name, $phone_country)) => Arr::get($this->$array_name, $phone_country)
                            ])
                        ></i>
                        {{ Arr::get($this->$array_name, $phone_country) ? Arr::get($countries[Arr::get($this->$array_name, $phone_country)], 'calling_code') : '+__' }}
                    @else
                        {{-- ToDo  EDO check with form object to show flag correctly ...--}}
                        <i @class([
                            $type_icon => !Arr::get($this, "$model.$phone_country"),
                            'flag ' . strtolower(Arr::get($this, "$model.$phone_country")) => Arr::get($this, "$model.$phone_country")
                        ])
                        ></i>
                        {{ Arr::get($this, "$model.$phone_country") ? Arr::get($countries[Arr::get($this, "$model.$phone_country")], 'calling_code') : '+__' }}
                    @endif
                </button>

                {{-- dropdown button --}}
                <button type="button" class="btn btn-alt-secondary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="visually-hidden">{{ __('toggle dropdown') }}</span>
                </button>

                {{-- dropdown menu --}}
                <div class="dropdown-menu" style="min-width: 220px; max-height: 40vh; overflow-y: auto;">
                    <div class="dropdown-item text-capitalize country-prefix-number" role="button"
                         data-name="{{ "$model.$phone_name" }}"
                    >
                        <i class="fas fa-remove me-1"></i> {{ __('clear') }}
                    </div>

                    <div role="separator" class="dropdown-divider"></div>

                    @foreach($countries as $iso_code => $country)
                        <div class="dropdown-item country-prefix-number" role="button"
                            data-name="{{ "$model.$phone_name" }}"
                            data-value="{{ $iso_code }}"
                            data-calling-code="{{ $country['calling_code'] }}"
                        >
                            <i class="flag {{ strtolower($iso_code) }} me-1"></i>
                            {{ $country['title'] }} ({{ $country['calling_code'] }})
                        </div>
                    @endforeach
                </div>

                {{-- Input --}}
                <input type="tel"
                   {{
                      $attributes->class([
                          config('x-form.input'),
                          config('x-form.invalid') => $errors->has($rule)
                      ])
                      ->merge([
                          'id' => $for,
                          'name' => $array_name . '[]',
                          'wire:model' . $modifier =>  "$model.$phone_name",
                          'wire:key' => "$model.$phone_name",
                      ])
                   }}

                   @if($modifier)
                       wire:dirty.class="{{ config('x-form.border') }}"
                   @endif

                   @if($tooltip && !$label)
                       data-bs-toggle="tooltip" title={{ $tooltip }}
                    @endif
                />

                {{-- country calling code is set via script function --}}

            </div>

            @error("$model.$phone_name")
                <small class="text-danger">
                    {{ $message }}
                </small>
            @enderror

            @if($floating && $label)
                <x-form.label
                    for="{{ $for }}" label="{!! $label !!}"
                    :model="$phone_country" :modifier="$modifier" :icon="$icon" :tooltip="$tooltip" :required="$required"
                />
                </div>
            @endif

            @error($rule)
                <div class="{{ config('x-form.error') }}">{{ $message }}</div>
            @enderror

        </div>

        @endfor

    @endforeach
</div>

{{-- the script will bind phone country code to the relevant phone number in the backend --}}
@push('page-js')
    <script>
        $(document).on('click', '.country-prefix-number', function() {
            var phone = $(this).attr('data-name');
            var phone_country = `${phone}_country`;
            var value = $(this).attr('data-value');

            if(!value) {
                @this.set(phone_country, '');
                @this.set(phone, '');

                $(this).parent().prev().prev().html('<i class="fas fa-phone-alt"></i> +__');
            }
            else {
                @this.set(phone_country, value);

                $(this).parent().prev().prev().html(`<i class="flag ${value.toLowerCase()}"></i> ${$(this).attr('data-calling-code')}`);
            }
        });
    </script>
@endpush
