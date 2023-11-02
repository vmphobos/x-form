<label for="{{ $for }}"
    @if($modifier && $model) wire:target="{{ $model }}" @endif

    @class([
        config('x-form.label'),
        config('x-form.required') => $required
    ])
    @if($tooltip)
        data-bs-toggle="tooltip"title="{{ $tooltip }}"
    @endif
>
    @if($icon)
        <i class="{{ $icon }}"
           @if($modifier && $model) wire:loading.remove wire:target="{{ $model }}" @endif
        ></i>
    @endif

    @if($modifier && $model)
        <span wire:loading wire:target="{{ $model }}" class="{{ config('x-form.spinner') }}"></span>
    @endif

    {!! $label !!}
</label>
