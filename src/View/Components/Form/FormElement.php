<?php

namespace Vmphobos\XForm\View\Components\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

abstract class FormElement extends Component
{
    public string $wire = 'wire:model';

    public ?string $uuid = null;
    public ?string $name = null;
    public ?string $model = null;
    public ?string $rule = null;
    public ?string $modifier = null;
    public ?string $prepend = null;
    public ?string $append = null;

    public function __construct()
    {
        $this->name ??= $this->model;
        $this->rule ??= $this->model ?? $this->name;

        if ($this->model && $this->modifier) {
            $this->modifier = '.' . ltrim($this->modifier, '.');
        }

        $this->uuid ??= md5(json_encode([
            $this->model,
            $this->name,
            $this->rule,
            now()->timestamp, // helps in dynamic forms with reactivity
        ]));
    }

    abstract public function render(): View|Closure|string;
}
