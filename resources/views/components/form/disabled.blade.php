{{-- Label as stylized text (not a <label>) --}}
@if($label)
    <div class="{{ config('x-form.label') }}">
        {{ $label }}
    </div>
@endif

{{-- Disabled Component Wrapper --}}
<div class="{{ config('x-form.disabled.class') }}">
    {{-- Prepend --}}
    @if($prepend)
        {{ $prepend }}
    @endif

    {{-- Fallback: Standard Disabled Block --}}
    @php
        $content = '<div class="flex items-center">'
            . (!$currency && $icon ? $icon . '<div class="' . config('x-form.disabled.divider') . '"></div>' : $icon)
            . ($slot->isNotEmpty() ? $slot : $value)
            . '</div>';
    @endphp

    @if($wrapper_tag)
        <{{ $wrapper_tag }}
            @foreach($wrapper_attributes as $attr => $val)
                {!! $attr !!}="{{ $val }}"
            @endforeach
            >
            {!! $content !!}
        </{{ $wrapper_tag }}>
    @else
        {!! $content !!}
    @endif



{{-- Append --}}
    {{ $append }}
</div>

