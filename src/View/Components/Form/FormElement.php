<?php

namespace XForm\View\Components\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

abstract class FormElement extends Component
{
    public $wire = 'wire:model';

    public ?string $name = '';

    public ?string $model = '';

    public ?string $rule = '';

    public ?string $modifier = '';

    public ?string $before = '';

    public ?string $after = '';

    public function __construct() {
        $this->name ??= $this->model;

        $this->rule ??= $this->model ?: $this->name;

        if($this->model && $this->modifier) {
            $this->modifier = ".$this->modifier";
        }
    }

    abstract public function render(): View|Closure|string;
}
