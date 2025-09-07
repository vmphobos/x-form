<?php

/**
| X-Form CSS classes
| You can extend this further if needed.
|
 */
return [

    /**
    |---------------------------------------------------------------------------
    | Label - <label>
    |---------------------------------------------------------------------------
    |
    | The class name for the <label> tag to stylize the text.
    | To override a label use <x-slot:label>
     */
    'label' => 'mb-1 text-sm font-normal tracking-wider text-dark/50 uppercase',
    'spinner' => 'spinner-border spinner-border-sm', //label spinner animation

    /**
    |---------------------------------------------------------------------------
    | Icons
    |---------------------------------------------------------------------------
    |
    | This array holds icon definitions for x-form.disabled.
    | Can be either class names (Tabler/FontAwesome etc.) or raw SVGs.
    | 'currency', 'copy', 'link', 'mail', 'phone', 'fax', 'map'
     */
    'icons' => [
        'copy' => 'ti ti-copy',
        'link' => 'ti ti-link',
        'email' => 'ti ti-mail',
        'phone' => 'ti ti-phone',
        'fax' => 'ti ti-printer',
        'map' => 'ti ti-map-pin',
        // Raw SVG example
        'info' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-info hover:cursor-pointer opacity-75 hover:opacity-100"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12" y2="8"></line></svg>',
    ],

    /**
    |---------------------------------------------------------------------------
    | Input, Textarea, Select
    |---------------------------------------------------------------------------
    |
    | Styling for different types of input elements.
    |
     */
    'input' => 'mt-2 p-2 flex items-center gap-2 bg-white rounded-md border border-gray-200 text-dark text-start focus:ring-2 focus:ring-primary outline-none w-full',

    'textarea' => 'mt-2 p-2 flex items-center gap-2 bg-white rounded-md border border-gray-200 text-dark text-start focus:ring-2 focus:ring-primary outline-none w-full',

    'select' => 'form-select form-control capitalize shadow-none',  // Could be customized further for Tailwind

    'dropdown' => 'mt-2 p-2 flex items-center gap-2 bg-white rounded-md border border-gray-200 text-dark text-start truncate w-full focus:text-primary focus:ring-2 focus:ring-primary hover:cursor-pointer hover:opacity-80',  // Tailwind-focused styling

    'check' => [
        'wrapper' => 'flex flex-row flex-wrap',
        'label' => 'capitalize',
        'input' => 'form-checkbox shadow-none',
        'horizontal' => 'flex flex-row items-center space-x-2 mt-2 pe-4',
        'vertical' => 'flex flex-col gap-2 mt-1',
        'empty_message' => 'capitalize text-muted', //when no data
        'group' => [
            'full' => 'w-full flex flex-row flex-wrap space-x-4 my-4',
            'column' => 'w-full sm:w-6/12 md:w-4/12 xl:w-3/12 my-4', //div group column
            'label' => 'mt-3 font-bold capitalize', //text title of group
        ],
    ],

    /**
    |---------------------------------------------------------------------------
    | Floating
    |---------------------------------------------------------------------------
    |
    | Class for floating label div.
    |
     */
    'floating' => 'relative',

    /**
    |---------------------------------------------------------------------------
    | Error
    |---------------------------------------------------------------------------
    |
    | Styling for error messages.
    |
     */
    'error' => 'text-danger',

    /**
    |---------------------------------------------------------------------------
    | Border - Only for Livewire
    |---------------------------------------------------------------------------
    |
    | Custom border class for when the input is dirty in Livewire.
    |
     */
    'border' => 'border-warning',

    /**
    |---------------------------------------------------------------------------
    | Disabled
    |---------------------------------------------------------------------------
    |
    | Custom classes for disabled elements.
    |
     */
    'disabled' => [
        'class' => 'mt-2 p-2 flex items-center gap-2 bg-gray-50 rounded-md border border-gray-200 text-dark text-start truncate w-full',
        'style' => ''
    ],
];
