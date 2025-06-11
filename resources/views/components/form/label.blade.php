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

    {{-- Label title --}}
    <span class="capitalize">{!! $label !!}</span>

    {{-- Loading spinner --}}
    @if($modifier && $model)
        <span
            wire:loading
            wire:target="{{ $model }}"
            class="{{ config('x-form.spinner') }}"
            aria-hidden="true"
        ></span>
    @endif
</label>

{{-- Tooltip icon --}}
@if($tooltip && !$help)
    <i
        class="ti ti-help-circle-filled"
        x-tooltip="{{ str($tooltip)->ucfirst() }}"
        role="tooltip"
        tabindex="0"
    ></i>
@endif

{{-- Help popover --}}
@if($help && !$tooltip)
    <span x-popover>
        <i
            class="ti ti-info-circle-filled cursor-pointer opacity-75 hover:opacity-100"
            data-trigger
            tabindex="0"
            role="button"
            aria-haspopup="dialog"
            aria-expanded="false"
        ></i>

        <div class="popover" data-popover role="dialog" aria-modal="true">
            <div class="row p-2 max-w-[450px]">
                <div class="col-12">
                    <small>{!! $help !!}</small>
                </div>
            </div>
        </div>
    </span>
@endif
