<?php

/**
| X-Form CSS classes
| You can extend this further if needed.
|
 */
$icon_size = 'size-4';

//Style all the inputs inc. background, text, border etc.
$base = [
    'bg' => 'bg-black/1 dark:bg-white/5 backdrop-blur-md shadow-xs',

    'border' => 'border border-black/5 dark:border-white/10',

    'rounded' => 'rounded-md',

    'text_color' => 'text-black/80 dark:text-white/90',

    'text_size' => 'text-sm',

    'focus' => 'focus:ring-1 focus:ring-black/50 dark:focus:ring-white/50 focus:ring-blue-500/50 focus:shadow-md outline-none',

    'flex' => 'flex items-center gap-2',

    'disabled_bg' => 'bg-black/5 dark:bg-white/5 backdrop-blur-md border border-black/5 dark:border-black/10',

    'disabled_text' => 'text-sm text-black/50 dark:text-white/60',

    'transition' => 'transition-all duration-200',

    'min_height' => [
        'input' => 'min-h-5',
        'disabled' => 'min-h-7',
    ],

    'check_radio_input' => 'flex items-center justify-center cursor-pointer rounded-sm border-1 border-dark/20 dark:border-white/20 transition peer-checked:border-dark/70 dark:peer-checked:border-white/30 dark:peer-checked:bg-white/10 peer-checked:[&>svg]:flex peer-checked:[&>svg]:opacity-100',

    'choice_horizontal' => 'flex flex-row items-center space-x-2 mt-1.5 pe-4',

    'choice_vertical' => 'flex flex-col gap-2 mt-1',
];

return [
    //The site of icons
    'icon_size' => $icon_size,

    // Label
    // Label
    'label' => implode(' ', [
        'block',
        'w-full',
        'mb-1',
        'tracking-wider',
        'font-medium',
        'opacity-90',
        $base['text_color'],
        $base['text_size'],
    ]),

// Inputs
    'item' => implode(' ', [
        $base['text_size'],
        $base['text_color'],
    ]),

    'input' => implode(' ', [
        $base['flex'],
        'w-full',
        'p-2',
        $base['min_height']['input'],
        $base['text_size'],
        $base['text_color'],
        $base['bg'],
        $base['border'],
        $base['rounded'],
        $base['focus'],
    ]),

    'textarea' => implode(' ', [
        $base['flex'],
        'w-full',
        'p-2',
        $base['text_size'],
        $base['text_color'],
        $base['bg'],
        $base['border'],
        $base['rounded'],
        $base['focus'],
    ]),

    'dropdown' => [
        'input' => implode(' ', [
            $base['flex'],
            'w-full',
            'p-2',
            $base['text_size'],
            $base['text_color'],
            $base['bg'],
            $base['border'],
            $base['rounded'],
            $base['focus'],
            'hover:cursor-pointer',
            'hover:opacity-80',
        ]),

        'item' => implode(' ', [
            'flex',
            'items-center',
            'w-full',
            'text-sm',
            'text-left',
            'gap-3',
            'pl-4',
            'py-2',
            'clear-both',
            $base['text_size'],
            $base['text_color'],
            'capitalize',
            'font-normal',
            'whitespace-nowrap',
            'border-none',
            'rounded-none',
            'hover:cursor-pointer',
            'hover:opacity-80',
            'hover:bg-black/5',
            'hover:dark:bg-white/10'
        ]),

        'search' => [
            'border' => 'border-dark/30 dark:border-white/30',
        ],
    ],

    // Radio groups
    'radio' => [
        'label' => 'text-sm capitalize',
        'input' => 'relative w-4 h-4 ' . $base['check_radio_input'],
        'horizontal' => $base['choice_horizontal'],
        'vertical' => $base['choice_vertical'],
    ],

    // Checkbox and radio groups
    'checkbox' => [
        'div' => 'flex items-center space-x-2',
        'label' => 'relative w-5 h-5 ' . $base['check_radio_input'],
        'input' => 'peer hidden',
        'horizontal' => $base['choice_horizontal'],
        'vertical' => 'flex flex-col gap-1 mt-1', // override gap-2 if needed
        'empty_message' => 'capitalize text-gray-500 dark:text-gray-300',
        'group' => [
            'label' => 'dark:text-gray-200 font-bold hover:cursor-pointer relative mb-1',
        ],
        'container' => 'column-count-md-2 column-count-lg-3 column-gap-md-2',
        'title' => "{$base['text_color']} text-xs",
        'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="size-4 stroke-black/80 dark:stroke-white/70 opacity-0 peer-checked:opacity-100 transition lucide lucide-check-icon lucide-check"><path d="M20 6 9 17l-5-5"/></svg>'
    ],


    'upload' => [
        'button' => implode(' ', [
            $base['flex'],
            $base['text_color'],
            $base['text_size'],
            'mt-1.5',
            'file:cursor-pointer',
            'file:mr-4',
            'file:py-2',
            'file:px-4',
            'file:rounded-lg',
            'file:border-0',
            'file:text-sm',
            'file:font-semibold',
            'file:bg-black/5',
            'dark:file:bg-white/10',
            'file:text-black/60',
            'dark:file:text-white',
            'hover:file:bg-black/10',
            'dark:hover:file:bg-white/20',
        ]),

        'dropzone' => [
            'button' => implode(' ', [
                $base['flex'],
                $base['rounded'],
                'flex-col',
                'items-center',
                'justify-center',
                'w-full',
                'h-64',
                'border',
                'border-dashed',
                'border-black/90',
                'dark:border-white/90',
                'hover:cursor-pointer',
                'bg-transparent',
                'hover:bg-white/10',
                'dark:hover:bg-black/10',
            ]),
            'title' => implode(' ', [
                $base['text_color'],
                $base['text_size'],
            ]),
            'subtitle' => implode(' ', [
                $base['text_color'],
                $base['text_size'],
            ]),
            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="size-8 fill-none stroke-black/80 dark:stroke-white/80 lucide lucide-cloud-upload-icon lucide-cloud-upload"><path d="M12 13v8"/><path d="M4 14.899A7 7 0 1 1 15.71 8h1.79a4.5 4.5 0 0 1 2.5 8.242"/><path d="m8 17 4-4 4 4"/></svg>',
        ],
    ],

    // Error messages for input
    'error' => 'text-danger-500',

    // Disabled field styling
    'disabled' => [
        'class' => implode(' ', [
            $base['flex'],
            'w-full',
            'text-start',
            'truncate',
            'p-2',
            $base['min_height']['disabled'],
            $base['disabled_bg'],
            $base['disabled_text'],
            $base['rounded'],
            'space-x-2',
        ]),
        'style' => '',
        'action' => 'w-full hover:opacity-80 ' . $base['transition'],
        'divider' => 'mx-2 h-5 w-px bg-black/10 dark:bg-white/10',
    ],

    /**
    |---------------------------------------------------------------------------
    | Icons
    |---------------------------------------------------------------------------
    |
    | This array holds icon definitions for x-form.disabled.
    | Can be either class names (Lucide/Tabler etc.) or raw SVGs.
    | 'currency', 'copy', 'link', 'mail', 'phone', 'fax', 'map'
     */
    'icons' => [
        'copy' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="' . $icon_size . ' lucidelucide-copy-icon lucide-copy"><rect width="14" height="14" x="8" y="8" rx="2" ry="2"/><path d="M4 16c-1.1 0-2-.9-2-2V4c0-1.1.9-2 2-2h10c1.1 0 2 .9 2 2"/></svg>',

        'link' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="' . $icon_size . ' lucidelucide-link-icon lucide-link"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"/><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"/></svg>',

        'email' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="' . $icon_size . ' lucidelucide-mail-icon lucide-mail"><path d="m22 7-8.991 5.727a2 2 0 0 1-2.009 0L2 7"/><rect x="2" y="4" width="20" height="16" rx="2"/></svg>',

        'phone' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="' . $icon_size . ' lucidelucide-phone-icon lucide-phone"><path d="M13.832 16.568a1 1 0 0 0 1.213-.303l.355-.465A2 2 0 0 1 17 15h3a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2A18 18 0 0 1 2 4a2 2 0 0 1 2-2h3a2 2 0 0 1 2 2v3a2 2 0 0 1-.8 1.6l-.468.351a1 1 0 0 0-.292 1.233 14 14 0 0 0 6.392 6.384"/></svg>',

        'fax' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="' . $icon_size . ' lucidelucide-printer-icon lucide-printer"><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"/><path d="M6 9V3a1 1 0 0 1 1-1h10a1 1 0 0 1 1 1v6"/><rect x="6" y="14" width="12" height="8" rx="1"/></svg>',

        'map' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="' . $icon_size . ' lucidelucide-map-pin-icon lucide-map-pin"><path d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0"/><circle cx="12" cy="10" r="3"/></svg>',

        'info' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="' . $icon_size . ' lucidelucide-badge-info-icon lucide-badge-info"><path d="M3.85 8.62a4 4 0 0 1 4.78-4.77 4 4 0 0 1 6.74 0 4 4 0 0 1 4.78 4.78 4 4 0 0 1 0 6.74 4 4 0 0 1-4.77 4.78 4 4 0 0 1-6.75 0 4 4 0 0 1-4.78-4.77 4 4 0 0 1 0-6.76Z"/><line x1="12" x2="12" y1="16" y2="12"/><line x1="12" x2="12.01" y1="8" y2="8"/></svg>',
    ],

    /**
    |---------------------------------------------------------------------------
    | Currency Icons
    |---------------------------------------------------------------------------
    |
     */
    'currency' => [
        'eur' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="' . $icon_size . ' lucide lucide-euro-icon lucide-euro"><path d="M4 10h12"/><path d="M4 14h9"/><path d="M19 6a7.7 7.7 0 0 0-5.2-2A7.9 7.9 0 0 0 6 12c0 4.4 3.5 8 7.8 8 2 0 3.8-.8 5.2-2"/></svg>',

        'dollar' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="' . $icon_size . ' lucide lucide-dollar-sign-icon lucide-dollar-sign"><line x1="12" x2="12" y1="2" y2="22"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>',

        'pound' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="' . $icon_size . ' lucide lucide-pound-sterling-icon lucide-pound-sterling"><path d="M18 7c0-5.333-8-5.333-8 0"/><path d="M10 7v14"/><path d="M6 21h12"/><path d="M6 13h10"/></svg>',

        'ruble' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="' . $icon_size . ' lucide lucide-russian-ruble-icon lucide-russian-ruble"><path d="M6 11h8a4 4 0 0 0 0-8H9v18"/><path d="M6 15h8"/></svg>',

        'yen' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="' . $icon_size . ' lucide lucide-japanese-yen-icon lucide-japanese-yen"><path d="M12 9.5V21m0-11.5L6 3m6 6.5L18 3"/><path d="M6 15h12"/><path d="M6 11h12"/></svg>',

        'indian' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="' . $icon_size . ' lucide lucide-indian-rupee-icon lucide-indian-rupee"><path d="M6 3h12"/><path d="M6 8h12"/><path d="m6 13 8.5 8"/><path d="M6 13h3"/><path d="M9 13c6.667 0 6.667-10 0-10"/></svg>',

        'bitcoin' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="' . $icon_size . ' lucide lucide-bitcoin-icon lucide-bitcoin"><path d="M11.767 19.089c4.924.868 6.14-6.025 1.216-6.894m-1.216 6.894L5.86 18.047m5.908 1.042-.347 1.97m1.563-8.864c4.924.869 6.14-6.025 1.215-6.893m-1.215 6.893-3.94-.694m5.155-6.2L8.29 4.26m5.908 1.042.348-1.97M7.48 20.364l3.126-17.727"/></svg>',

        'coins' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="' . $icon_size . ' lucide lucide-coins-icon lucide-coins"><circle cx="8" cy="8" r="6"/><path d="M18.09 10.37A6 6 0 1 1 10.34 18"/><path d="M7 6h1v4"/><path d="m16.71 13.88.7.71-2.82 2.82"/></svg>',
    ],
];
