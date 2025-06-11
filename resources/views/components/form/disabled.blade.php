{{-- Label --}}
@if($label)
    <x-form.label
        label="{!! $label !!}"
        :icon="$icon"
        :help="$tooltip"
    />
@endif

{{-- Disabled Component Wrapper --}}
<div class="flex items-center space-x-2">
    {{-- Prepend --}}
    @if($prepend)
        {{ $prepend }}
    @endif

    {{-- Handle Predefined Actions (Currency, Copy, Link, Mail, Phone, Fax, Map) --}}
    @if($value)
        @if($currency)
            <span class="p-2 rounded-md bg-light text-dark">{{ $currency }}</span>
        @elseif ($copy)
            <span class="p-2 rounded-md bg-light text-dark cursor-pointer"
                  @click="window.navigator.clipboard.writeText($el.getAttribute(@js('value'))); success('Link has been copied to clipboard!')"
                  value="{{ $value }}"
                  x-tooltip="{{ str(__('copy to clipboard'))->apa() }}"
            >
                <i class="{{ config('x-form.icons.copy') }}" role="button"></i>
            </span>
        @elseif ($link)
            <span class="p-2 rounded-md bg-light text-dark cursor-pointer"
                  x-tooltip="{{ str(__('open link in a new tab'))->apa() }}"
            >
                <a href="{{ $value }}" class="text-dark" target="_blank"><i class="{{ config('x-form.icons.link') }}"></i></a>
            </span>
        @elseif ($mail)
            <span class="p-2 rounded-md bg-light text-dark cursor-pointer"
                  x-tooltip="{{ str(__('send email'))->apa() }}"
            >
                <a href="mailto:{{ $value }}" class="text-dark"><i class="{{ config('x-form.icons.email') }}"></i></a>
            </span>
        @elseif ($phone)
            <span class="p-2 rounded-md bg-light text-dark cursor-pointer"
                  x-tooltip="{{ str(__('click to dial'))->apa() }}"
            >
                <a href="tel:{{ $value }}" class="text-dark"><i class="{{ config('x-form.icons.phone') }}"></i></a>
            </span>
        @elseif ($fax)
            <span class="p-2 rounded-md bg-light text-dark cursor-pointer"
                  x-tooltip="{{ str(__('click to send a fax'))->apa() }}"
            >
                <a href="fax:{{ $value }}" class="text-dark"><i class="{{ config('x-form.icons.fax') }}"></i></a>
            </span>
        @elseif ($map)
            <span class="p-2 rounded-md bg-light text-dark cursor-pointer"
                  x-tooltip="{{ str(__('open address in google map'))->apa() }}"
            >
                <a href="http://maps.google.com/?q={{ $value }}" target="_blank"><i class="{{ config('x-form.icons.map') }}"></i></a>
            </span>
        @endif
    @endif

    {{-- Disabled Component --}}

    <div
        {{
            $attributes->class([
                config('x-form.disabled.class'),
                'user-select-all' => $copy && $value,
                'bg-gray-100 text-gray-400' => true,  // Tailwind disabled styling
            ])->merge()
        }}
        @if(config('x-form.disabled.style')) style="{{ config('x-form.disabled.style') }}" @endif
    >
        {{-- Slot Content (can be any HTML passed inside the component) --}}
        {{ $slot->isNotEmpty() ? $slot : '-' }}
    </div>

    {{-- Append --}}
    {{ $append }}
</div>
