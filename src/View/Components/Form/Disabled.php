<?php

namespace Vmphobos\XForm\View\Components\Form;

use Closure;
use Illuminate\Support\Str;
use Illuminate\View\Component;
use Illuminate\View\ComponentAttributeBag;
use Illuminate\View\View;

class Disabled extends Component
{
    public function __construct(
        public ?string $label = null,
        public ?string $value = null,
        public ?string $icon = null,
        public ?string $tooltip = null,
        public ?string $prepend = null,
        public ?string $append = null,
        public ?string $currency = null,
        public bool $copy = false,
        public bool $link = false,
        public bool $mail = false,
        public bool $phone = false,
        public bool $fax = false,
        public bool $map = false,
        public ?string $wrapper_tag = null,
        public array $wrapper_attributes = [],
    ) {
        $this->setIcon();
    }

    private function setIcon(): void
    {
        if (!$this->icon) {
            $this->icon = $this->getIconFromAttributes();
        }

        if ($this->icon) {
            $this->renderIcon();
            $this->renderButton();
        }
    }

    /**
     * Retrieve the icon value based on the attributes.
     *
     * @return string|null
     */
    private function getIconFromAttributes(): ?string
    {
        if ($this->currency) {
           return $this->getCurrencyIcon();
        }

        return match (true) {
            $this->copy => config('x-form.icons.copy'),
            $this->link => config('x-form.icons.link'),
            $this->mail => config('x-form.icons.mail'),
            $this->phone => config('x-form.icons.phone'),
            $this->fax => config('x-form.icons.fax'),
            $this->map => config('x-form.icons.map'),
            default => null,
        };
    }

    private function getCurrencyIcon():? string
    {
        return match (true) {
            $this->currency == 'euro' => config('x-form.currency.eur'),
            $this->currency == 'dollar' => config('x-form.currency.dollar'),
            $this->currency == 'pound' => config('x-form.currency.pound'),
            $this->currency == 'ruble' => config('x-form.currency.ruble'),
            $this->currency == 'yen' => config('x-form.currency.yen'),
            $this->currency == 'indian' => config('x-form.currency.indian'),
            $this->currency == 'bitcoin' => config('x-form.currency.bitcoin'),
            default => config('x-form.icons.coins'),
        };
    }

    /**
     * Render the icon as an <i> tag or use it directly.
     *
     * @return void
     */
    private function renderIcon(): void
    {
        // If it's not an HTML icon string, wrap it in an <i> tag.
        if (!Str::contains($this->icon, ['<', '>'])) {
            $this->icon = "<i class=\"$this->icon\"></i>";
        }
    }

    /**
     * Render the button (with proper link behavior) for different icon types.
     *
     * @return void
     */
    private function renderButton(): void
    {
        if ($this->copy) {
            $this->wrapper_tag = 'button';
            $this->wrapper_attributes = [
                'type' => 'button',
                '@click' => "window.navigator.clipboard.writeText('" . e($this->value) . "'); success('Copied!')",
                'class' => config('x-form.disabled.action'),
                'aria-label' => "Click to Copy {$this->value}",
            ];
        } elseif ($this->link) {
            $this->wrapper_tag = 'a';
            $this->wrapper_attributes = [
                'href' => $this->value,
                'target' => '_blank',
                'class' => config('x-form.disabled.action'),
                'aria-label' => "Click to open {$this->value} to a new tab",
            ];
        } elseif ($this->mail) {
            $this->wrapper_tag = 'a';
            $this->wrapper_attributes = [
                'href' => 'mailto:' . $this->value,
                'class' => config('x-form.disabled.action'),
                'aria-label' => "Click to send email to {$this->value}",
            ];
        } elseif ($this->phone) {
            $this->wrapper_tag = 'a';
            $this->wrapper_attributes = [
                'href' => 'tel:' . $this->value,
                'class' => config('x-form.disabled.action'),
                'aria-label' => "Click to call phone number: $this->value",
            ];
        } elseif ($this->fax) {
            $this->wrapper_tag = 'a';
            $this->wrapper_attributes = [
                'href' => 'fax:' . $this->value,
                'class' => config('x-form.disabled.action'),
                'aria-label' => "Click to call fax number: {$this->value}",
            ];
        } elseif ($this->map) {
            $this->wrapper_tag = 'a';
            $this->wrapper_attributes = [
                'href' => 'http://maps.google.com/?q=' . urlencode($this->value),
                'target' => '_blank',
                'class' => config('x-form.disabled.action'),
                'aria-label' => "Click to view location on Google Maps",
            ];
        }
    }

    public function render(): View|Closure|string
    {
        return view('x-form::disabled');
    }
}
