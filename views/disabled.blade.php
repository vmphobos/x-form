@if($label)
    <x-form.label label="{!! $label !!}" :icon="$icon" />
@endif

<div class="input-group">
    @if($prepend)
        {{ $prepend }}
    @else
        @if($value)
            @if($selectable)
                <span class="input-group-text btn btn-light copy-text">
                    <i class="fa-regular fa-copy mt-1" role="button"></i>
                </span>
            @elseif($link)
                <span class="input-group-text btn btn-light">
                    <a href="{{ $value }}" class="text-dark"><i class="fa-regular fa-link"></i></a>
                </span>
            @elseif($mail)
                <span class="input-group-text btn btn-light">
                    <a href="mailto:{{ $value }}" class="text-dark"><i class="fa-regular fa-envelope"></i></a>
                </span>
            @elseif($phone)
                <span class="input-group-text btn btn-light">
                    <a href="tel:{{ $value }}" class="text-dark"><i class="fa-solid fa-phone-flip"></i></a>
                </span>
            @elseif($fax)
                <span class="input-group-text btn btn-light">
                    <a href="fax:{{ $value }}" class="text-dark"><i class="fa-solid fa-fax"></i></a>
                </span>
            @elseif($map)
                <span class="input-group-text btn btn-light">
                    <a href="http://maps.google.com/?q={{ $value }}" target="_blank"><i class="fa-solid fa-location-dot"></i></a>
                </span>
            @endif
        @endif
    @endif

    <div
        {{
            $attributes->class([
                config('x-form.disabled.class'),
                'user-select-all' => $selectable && $value
            ])
        }}
        style="{{ config('x-form.disabled.style') }}"
    >
        {{ (!empty($value) || is_numeric($value)) ? $value : '-' }}
    </div>

    {{ $append }}
</div>
