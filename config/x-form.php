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
    'label' => 'mb-1 text-sm font-normal tracking-wider text-dark/50 uppercase',

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
        'phone' => 'ti ti-phone',  // Tabler icon class
        'fax' => 'ti ti-printer',  // Tabler icon class
        'map' => 'ti ti-map-pin',  // Tabler icon class
        // Raw SVG example
        'info' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-info cursor-pointer opacity-75 hover:opacity-100"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12" y2="8"></line></svg>', // Example SVG icon
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
    'input' => 'mt-2 p-2 flex items-center gap-2 bg-white rounded-md border border-gray-200 text-dark text-start focus:ring-2 focus:ring-primary w-full',

    'textarea' => 'mt-2 p-2 flex items-center gap-2 bg-white rounded-md border border-gray-200 text-dark text-start focus:ring-2 focus:ring-primary w-full',

    'select' => 'form-select form-control capitalize shadow-none',  // Could be customized further for Tailwind

    'dropdown' => 'mt-2 p-2 flex items-center gap-2 bg-white rounded-md border border-gray-200 text-dark text-start truncate w-full focus:ring-2 focus:ring-primary cursor-pointer hover:opacity-80',  // Tailwind-focused styling

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
    'error' => 'invalid-feedback',

    /**
    |---------------------------------------------------------------------------
    | Border - Only for Livewire
    |---------------------------------------------------------------------------
    |
    | Custom classes for when the input is dirty in Livewire.
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
