<?php

namespace Vmphobos\XForm\View\Components\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Editor extends Component
{
    public function __construct(
        public ?string $uuid = null,
        public ?string $label = null,
        public ?string $content = null,
        public ?string $model = null,
        public ?string $rule = null,
        public ?bool $withFilemanager = false,
    )
    {
        $this->rule ??= $this->model;

        $this->uuid ??= str_replace(['.', '[', ']'], '-', $this->model);
    }

    public function render(): View|Closure|string
    {
        return view('x-form::editor');
    }
}
