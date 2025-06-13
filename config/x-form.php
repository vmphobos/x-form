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
    'label' => 'mb-1 text-sm font-normal tracking-wider text-dark/50 dark:text-gray-300 uppercase',

    /**
    |---------------------------------------------------------------------------
    | Icons
    |---------------------------------------------------------------------------
    |
    | This array holds icon definitions for different components.
    | Can be either class names (Tabler/FontAwesome) or raw SVGs.
    |
     */
    'icons' => [
        'copy' => 'ti ti-copy',  // Tabler icon class
        'link' => 'ti ti-link',  // Tabler icon class
        'email' => 'ti ti-mail',  // Tabler icon class
        'phone' => '<svg  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"  fill="currentColor"  class="w-4 h-4"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 3a1 1 0 0 1 .877 .519l.051 .11l2 5a1 1 0 0 1 -.313 1.16l-.1 .068l-1.674 1.004l.063 .103a10 10 0 0 0 3.132 3.132l.102 .062l1.005 -1.672a1 1 0 0 1 1.113 -.453l.115 .039l5 2a1 1 0 0 1 .622 .807l.007 .121v4c0 1.657 -1.343 3 -3.06 2.998c-8.579 -.521 -15.418 -7.36 -15.94 -15.998a3 3 0 0 1 2.824 -2.995l.176 -.005h4z" /></svg>',  // Tabler icon class
        'fax' => 'ti ti-printer',  // Tabler icon class
        'map' => 'ti ti-map-pin',  // Tabler icon class
        // Raw SVG example
        'info' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-info cursor-pointer opacity-75 hover:opacity-100"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12" y2="8"></line></svg>',
    ],

    /**
    |---------------------------------------------------------------------------
    | Input, Textarea, Select
    |---------------------------------------------------------------------------
    |
    | Styling for different types of input elements.
    | Tailwind utilities added for better styling with Tailwind.
    |
     */
    'input' => 'mt-2 p-2 flex items-center gap-2 bg-white dark:bg-dark dark:border-dark-800 rounded-md border border-gray-200 text-gray-500 dark:text-light text-start focus:ring-2 focus:ring-primary outline-none w-full',

    'textarea' => 'mt-2 p-2 flex items-center gap-2 bg-white dark:bg-dark dark:border-dark-800 rounded-md border border-gray-200 text-gray-500 dark:text-light text-start focus:ring-2 focus:ring-primary outline-none w-full',

    'select' => 'form-select form-control capitalize shadow-none',  // Could be customized further for Tailwind

    'dropdown' => 'mt-2 p-2 flex items-center gap-2 bg-white dark:bg-dark rounded-md border border-gray-200 dark:border-dark-800 text-gray-500 dark:text-light text-start truncate w-full focus:text-primary focus:ring-2 focus:ring-primary cursor-pointer hover:opacity-80',  // Tailwind-focused styling

    'dropdown-item' => 'flex items-center w-full text-left gap-3 pl-4 py-2 clear-both font-normal cursor-pointer whitespace-nowrap text-gray-500 dark:text-dark-100 border-none rounded-none hover:opacity-80 hover:bg-gray-100 hover:dark:bg-dark-800 capitalize',

    /**
    |---------------------------------------------------------------------------
    | Floating
    |---------------------------------------------------------------------------
    |
    | Tailwind-based class for floating labels. You can extend this further if needed.
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
    | Custom classes for when the input is dirty in Livewire.
    |
     */
    'border' => 'border-warning',

    'check' => [
        'div' => 'form-check',
        'label' => 'form-check-label capitalize',
        'input' => 'form-check-input shadow-none',
        'horizontal' => 'flex space-x-4 py-2.5 mt-1',
        'vertical' => 'flex flex-col gap-1 mt-1',
        'inline' => 'form-check-inline', //usable if horizontal is enabled
        'empty_message' => 'capitalize text-muted', //when no data
        'group' => [
            'div' => 'inline-block w-full ', //the div that surrounds a group of checkboxes or radios
            'label' => 'mt-3 font-bold', //the label headline for each group of checkboxes or radios
        ],
    ],

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
