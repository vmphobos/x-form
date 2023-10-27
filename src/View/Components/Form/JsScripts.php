<?php

namespace XForm\View\Components\Form;

use Closure;
use Illuminate\View\Component;
use Illuminate\View\View;

class Disabled extends Component
{
    public function __construct(
    )
    {
        /**
         *  return required scripts
         */
    }

    public function render(): View|Closure|string
    {
        return <<<'HTML'
            <script>
              $('.copy-text').on('click', function() {
                  var $this = $(this).parent();
                  $this.focus().select();
                  navigator.clipboard.writeText($this.text());
              });
            </script>
        HTML;
    }
}
