<label
    for="{{ e($for) }}"
    @if($modifier && $model)
        wire:target="{{ $model }}"
    @endif
    {{
        $attributes->class([
            config('x-form.label'),
            config('x-form.required') => $required,
        ])
    }}
>
    {{-- Label icon --}}
    @if($icon)
        <i
            class="{{ $icon }}"
            aria-hidden="true"
            @if($modifier && $model) wire:loading.remove wire:target="{{ $model }}" @endif
        ></i>
    @endif

    {{-- Loading spinner --}}
    @if($modifier && $model)
        <svg
            wire:loading
            wire:target="{{ $model }}"
            aria-hidden="true"
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            stroke-width="2"
            stroke-linecap="round"
            stroke-linejoin="round"
            class="inline size-4 lucide lucide-loader-circle-icon lucide-loader-circle animate-spin"
        >
            <path d="M21 12a9 9 0 1 1-6.219-8.56" />
        </svg>
    @endif
    
    {!! $label !!}
</label>

{{-- Tooltip icon --}}
@if($tooltip && !$help)
    <span
        x-tooltip="{{ str($tooltip)->ucfirst() }}"
        role="tooltip"
        tabindex="0"
    >{!! config('x-form.icons.info') !!}</span>
@endif

{{-- Help popover --}}
@if($help && !$tooltip)
    <div x-popover class="inline">
        {!! config('x-form.icons.info') !!}

        <div class="popover" data-popover role="dialog" aria-modal="true">
            <div class="row p-2 max-w-[450px]">
                <div class="col-12">
                    <small>{!! $help !!}</small>
                </div>
            </div>
        </div>
    </div>
@endif
