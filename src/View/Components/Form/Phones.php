<?php

namespace XForm\View\Components\Form;

use App\Models\Country;
use Closure;
use Illuminate\Contracts\View\View;

class Phones extends FormElement
{
    public function __construct(
        public ?array $countries = [],
        public ?array $phone_types = [],
        public ?string $uuid = null,
        public ?string $name = 'phone_numbers', //default array name
        public ?string $model = null,
        public ?string $label = null,
        public ?string $icon = null,
        public ?string $modifier = null,
        public ?string $rule = null,
        public ?string $tooltip = null,
        public int $phone = 2,
        public int $mobile = 1,
        public int $fax = 1,
        public ?bool $floating = false,
        public ?bool $required = false,
        public ?bool $dirty = false,
        public ?bool $single = false,
    ) {
        if ($this->dirty) {
            $this->modifier ??= 'blur';
        }

        //this should either return a model or a static country array key-ed by iso code with title and calling code
        $this->countries = Country::getFromCache()->keyBy('iso_code')->map->only(['title', 'calling_code'])->toArray();

        $this->phone_types = [
            'phone' => 'fa-solid fa-phone-flip',
            'mobile' => 'fa-solid fa-mobile',
            'fax' => 'fa-solid fa-fax',
        ];

        //if model exists we have either a dot array or a form object
        if($this->model) {
            //if model is a form object setup phone numbers object
            if(!str($this->model)->contains('.')) {
                $this->model = "$this->model.$this->name";
            }
        } else {
            $this->model = $this->name;
        }

        parent::__construct();

        $this->uuid = md5(json_encode($this));
    }

    public function render(): View|Closure|string
    {
        //if <x-form.phones single /> then return single phone input
        if($this->single) {
            return view('components.form.phone-number');
        }

        return view('components.form.phones');
    }
}
