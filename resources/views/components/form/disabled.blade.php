{{-- Label as stylized text (not a <label>) --}}
@if($label)
    <div class="mb-1 text-sm font-normal tracking-wider text-dark/50 uppercase">
        {!! $label !!}
    </div>
@endif

{{-- Disabled Component Wrapper --}}
<div class="flex items-center space-x-2">
    {{-- Prepend --}}
    @if($prepend)
        {{ $prepend }}
    @endif

    @php
        $iconHtml = null;

        if ($copy) {
            $iconHtml = '<div @click="window.navigator.clipboard.writeText(\'' . e($value) . '\'); success(\'Copied!\')" class=\'cursor-pointer\'>' . render_icon(config('x-form.icons.copy')) . '</div>';
        } elseif ($link) {
            $iconHtml = '<a href="' . $value . '" target="_blank">' . render_icon(config('x-form.icons.link')) . '</a>';
        } elseif ($mail) {
            $iconHtml = '<a href="mailto:' . $value . '">' . render_icon(config('x-form.icons.email')) . '</a>';
        } elseif ($phone) {
            $iconHtml = '<a href="tel:' . $value . '">' . render_icon(config('x-form.icons.phone')) . '</a>';
        } elseif ($fax) {
            $iconHtml = '<a href="fax:' . $value . '">' . render_icon(config('x-form.icons.fax')) . '</a>';
        } elseif ($map) {
            $iconHtml = '<a href="http://maps.google.com/?q=' . urlencode($value) . '" target="_blank">' . render_icon(config('x-form.icons.map')) . '</a>';
        }
    @endphp

    @if($iconHtml)
        {{-- Grouped Icon + Text --}}
        <div class="flex items-center overflow-hidden rounded-md border border-gray-200 bg-gray-100 text-gray-400 w-full">
            {{-- Icon side --}}
            <div class="flex items-center justify-center px-3 border-r border-gray-200 bg-light text-dark">
                {!! $iconHtml !!}
            </div>

            {{-- Disabled-style text content --}}
            <div class="flex-1 px-3 py-2 truncate">
                {{ $value }}
            </div>
        </div>
    @else
        {{-- Fallback: Standard Disabled Block --}}
        <div
            {{
                $attributes->class([
                    config('x-form.disabled.class'),
                    'user-select-all' => $copy && $value,
                    'bg-gray-100 text-gray-400' => true,
                ])->merge()
            }}
            @if(config('x-form.disabled.style')) style="{{ config('x-form.disabled.style') }}" @endif
        >
            {{ $slot->isNotEmpty() ? $slot : '-' }}
        </div>
    @endif

    {{-- Append --}}
    {{ $append }}
</div>
