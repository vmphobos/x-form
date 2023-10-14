<?php

return [

    /**
    |---------------------------------------------------------------------------
    | Label - <label>
    |---------------------------------------------------------------------------
    |
    | The class name for the <label> tag to stylize the text title.
    |
     */
    'label' => 'form-label fw-bold text-capitalize',
    'spinner' => 'spinner-border spinner-border-sm',

    /**
    |---------------------------------------------------------------------------
    | Required - <label>
    |---------------------------------------------------------------------------
    |
    | Adding required to the <label> tag class will add a red asterisk next to
    | the label's title for bootstrap.
    |
     */
    'required' => 'required',

    /**
    |---------------------------------------------------------------------------
    | Disabled - <div>
    |---------------------------------------------------------------------------
    |
    | The full class name of the div to surround your value and show as a disabled
    | input.
    |
     */
    'disabled' => [
        'class' => 'form-control form-control-alt text-capitalize',
        'style' => 'background: #d5dbe1;'
    ],

    /**
    |---------------------------------------------------------------------------
    | Invalid - <input, select, textarea>
    |---------------------------------------------------------------------------
    |
    | The class name to make the input invalid when there is an error. Usable on
    | all available input fields.
    |
     */
    'invalid' => 'is-invalid',

    /**
    |---------------------------------------------------------------------------
    | Error - <div>
    |---------------------------------------------------------------------------
    |
    | The class name for the div that surrounds the error message for an input.
    | The <div> tag is always placed after any input tag.
    |
     */
    'error' => 'invalid-feedback',

    /**
    |---------------------------------------------------------------------------
    | Border - <input, select, textarea> [Livewire Only]
    |---------------------------------------------------------------------------
    |
    | The classname to alert any input tag for changes. Available only when live
    |  or blur modifier is available on the input.
    |
     */
    'border' => 'border-warning',

    /**
    |---------------------------------------------------------------------------
    | Input - <input, textarea, select>
    |---------------------------------------------------------------------------
    |
    | The classname of the <input> tag
    |
     */
    'input' => 'form-control shadow-none',

    'textarea' => 'form-control shadow-none',

    'select' => 'form-select text-capitalize shadow-none',

    /**
    |---------------------------------------------------------------------------
    | Checkbox & Radio - <input type="checkbox,radio">
    |---------------------------------------------------------------------------
    |
    | Please refer to bootstrap for the layout.
    |
     */
    'check' => [
        'div' => 'form-check',
        'label' => 'form-check-label text-capitalize',
        'input' => 'form-check-input shadow-none',
        'horizontal' => 'space-x-2',
        'vertical' => 'space-y-2',
        'inline' => 'form-check-inline', //usable if horizontal is enabled
        'empty_message' => 'text-capitalize text-muted', //when no data
        'group' => [
            'div' => 'd-inline-block w-100', //the div that surrounds a group of checkboxes or radios
            'label' => 'mt-3 fw-bold', //the label headline for each group of checkboxes or radios
        ],
    ],

    /**
    |---------------------------------------------------------------------------
    | Floating [Wrapper]
    |---------------------------------------------------------------------------
    |
    | The class name of the div that surrounds and wraps inputs and label. Usable
    | only when you add the word floating in the blade component.
    |
     */
    'floating' => 'form-floating',
];
