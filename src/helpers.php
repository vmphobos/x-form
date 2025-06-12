<?php

use Illuminate\Support\Str;

if (! function_exists('render_icon')) {
    function render_icon($icon): string
    {
        return Str::contains($icon, '<svg')
            ? $icon
            : '<i class="' . $icon . '"></i>';
    }
}
