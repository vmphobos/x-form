<div>
    <div x-data="editor('{{ $uuid }}', '{{ $model }}', $wire)">
        @if($label)
            <div class="{{ config('x-form.label') }}">{{ $label }}</div>
        @endif
        {{-- ACTIONS --}}
        <div class="flex flex-wrap space-x-2 items-center bg-black/5 dark:bg-white/10 px-3 border border-black/5 dark:border-white/20 border-b-0 shadow rounded-t-md">
            {{-- HEADINGS --}}
            <div x-data="{ open: false }" @click.outside="open = false">
                <button
                    type="button"
                    x-ref="button"
                    @click="open = ! open"
                    class="p-1 hover:bg-black/5 dark:hover:bg-white/5 text-black dark:text-white hover:cursor-pointer rounded-sm"
                    title="{{ __('Change headings (H1,H2,H3...)') }}"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="20"
                        height="20"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        class="icon icon-tabler icons-tabler-outline icon-tabler-heading"
                    >
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M7 12h10" />
                        <path d="M7 5v14" />
                        <path d="M17 5v14" />
                        <path d="M15 19h4" />
                        <path d="M15 5h4" />
                        <path d="M5 19h4" />
                        <path d="M5 5h4" />
                    </svg>
                </button>

                <div
                    x-show="open"
                    x-anchor="$refs.button"
                    class="bg-white shadow-lg border border-gray-200 rounded-sm flex flex-col"
                >
                    <button
                        type="button"
                        @click="action.formatSelection('paragraph'), open = false"
                        class="w-full text-sm px-5 py-1 hover:bg-gray-100 hover:cursor-pointer"
                    >Paragraph
                    </button>
                    <template x-for="h in [1,2,3,4,5,6]" :key="h">
                        <button
                            type="button"
                            @click="action.formatSelection('heading', h), open = false"
                            class="w-full text-sm px-5 py-1 hover:bg-gray-100 hover:cursor-pointer"
                            :style="{ 'font-size': (30 - (h/0.3)) + 'px' }"
                        >
                            Heading <span x-text="h"></span>
                        </button>
                    </template>
                </div>
            </div>

            {{-- FONT SIZE --}}
            <div x-data="{ open: false }" @click.outside="open = false">
                <button
                    type="button"
                    x-ref="button"
                    @click="open = ! open"
                    class="p-1 hover:bg-black/5 dark:hover:bg-white/5 text-black dark:text-white hover:cursor-pointer rounded-sm"
                    title="{{ __('Text Size') }}"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="20"
                        height="20"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        class="icon icon-tabler icons-tabler-outline icon-tabler-text-size"
                    >
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M3 7v-2h13v2" />
                        <path d="M10 5v14" />
                        <path d="M12 19h-4" />
                        <path d="M15 13v-1h6v1" />
                        <path d="M18 12v7" />
                        <path d="M17 19h2" />
                    </svg>
                </button>

                <div
                    x-show="open"
                    x-anchor="$refs.button"
                    class="bg-white shadow-lg border border-gray-200 rounded-sm flex flex-col"
                >
                    <template x-for="px in [10,12,14,16,18,20,22]" :key="px">
                        <button
                            type="button"
                            @click="action.formatSelection('fontSize', px), open = false"
                            class="w-full px-5 py-1 hover:bg-gray-100 hover:cursor-pointer"
                            :style="{ 'font-size': px + 'px' }"
                        >
                            <span x-text="px"></span>px
                        </button>
                    </template>
                </div>
            </div>

            {{-- BOLD --}}
            <button
                type="button"
                @click="action.toggleBold()"
                :class="{'bg-gray-300': isBold}"
                class="p-1 hover:bg-black/5 dark:hover:bg-white/5 text-black dark:text-white hover:cursor-pointer rounded-sm"
                title="{{ __('Bold') }}"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="20"
                    height="20"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    class="icon icon-tabler icons-tabler-outline icon-tabler-bold"
                >
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M7 5h6a3.5 3.5 0 0 1 0 7h-6z" />
                    <path d="M13 12h1a3.5 3.5 0 0 1 0 7h-7v-7" />
                </svg>
            </button>

            {{-- ITALIC --}}
            <button
                type="button"
                @click="action.toggleItalic()"
                :class="{'bg-gray-300': isItalic}"
                class="p-1 hover:bg-black/5 dark:hover:bg-white/5 text-black dark:text-white hover:cursor-pointer rounded-sm"
                title="{{ __('Italic') }}"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="20"
                    height="20"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    class="icon icon-tabler icons-tabler-outline icon-tabler-italic"
                >
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M11 5l6 0" />
                    <path d="M7 19l6 0" />
                    <path d="M14 5l-4 14" />
                </svg>
            </button>

            {{-- UNDERLINE --}}
            <button
                type="button"
                @click="action.toggleUnderline()"
                :class="{'bg-gray-300': isUnderline}"
                class="p-1 hover:bg-black/5 dark:hover:bg-white/5 text-black dark:text-white hover:cursor-pointer rounded-sm"
                title="{{ __('Underline') }}"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="20"
                    height="20"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    class="icon icon-tabler icons-tabler-outline icon-tabler-underline"
                >
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M7 5v5a5 5 0 0 0 10 0v-5" />
                    <path d="M5 19h14" />
                </svg>
            </button>

            {{-- STRIKETHROUGH --}}
            <button
                type="button"
                @click="action.toggleStrikethrough()"
                :class="{'bg-gray-300': isStrikethrough}"
                class="p-1 hover:bg-black/5 dark:hover:bg-white/5 text-black dark:text-white hover:cursor-pointer rounded-sm"
                title="{{ __('Strikethrough') }}"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="20"
                    height="20"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    class="icon icon-tabler icons-tabler-outline icon-tabler-strikethrough"
                >
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M5 12l14 0" />
                    <path d="M16 6.5a4 2 0 0 0 -4 -1.5h-1a3.5 3.5 0 0 0 0 7h2a3.5 3.5 0 0 1 0 7h-1.5a4 2 0 0 1 -4 -1.5" />
                </svg>
            </button>

            <div>
                {{-- TEXT COLOR --}}
                <button
                    id="{{ $uuid }}_text_picker"
                    type="button" @click="colorPicker.openColorPicker($el, 'text')"
                    class="p-1 hover:bg-black/5 dark:hover:bg-white/5 text-black dark:text-white hover:cursor-pointer rounded-sm"
                    x-ref="text_picker"
                    title="{{ __('Text Color') }}"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="20"
                        height="20"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        class="stroke-sky-600 icon icon-tabler icons-tabler-outline icon-tabler-text-color"
                    >
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M9 15v-7a3 3 0 0 1 6 0v7" />
                        <path d="M9 11h6" />
                        <path d="M5 19h14" />
                    </svg>
                </button>

                {{-- BG COLOR --}}
                <button
                    id="{{ $uuid }}_bg_picker"
                    type="button" @click="colorPicker.openColorPicker($el, 'background')"
                    class="p-1 hover:bg-black/5 dark:hover:bg-white/5 text-black dark:text-white hover:cursor-pointer rounded-sm"
                    x-ref="bg_picker"
                    title="{{ __('Background Color') }}"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="20"
                        height="20"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        class="stroke-1 stroke-gray-600 fill-yellow-200 icon icon-tabler icons-tabler-outline icon-tabler-highlight"
                    >
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M3 19h4l10.5 -10.5a2.828 2.828 0 1 0 -4 -4l-10.5 10.5v4" />
                        <path d="M12.5 5.5l4 4" />
                        <path d="M4.5 13.5l4 4" />
                        <path d="M21 15v4h-8l4 -4z" />
                    </svg>
                </button>
            </div>

            {{-- TEXT CASE CHANGE --}}
            <div x-data="{ open: false }" @click.outside="open = false">
                <button
                    type="button"
                    x-ref="button"
                    @click="open = ! open"
                    class="p-1 hover:bg-black/5 dark:hover:bg-white/5 text-black dark:text-white hover:cursor-pointer rounded-sm"
                    title="{{ __('Text Cases') }}"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="20"
                        height="20"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        class="icon icon-tabler icons-tabler-outline icon-tabler-letter-case"
                    >
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M17.5 15.5m-3.5 0a3.5 3.5 0 1 0 7 0a3.5 3.5 0 1 0 -7 0" />
                        <path d="M3 19v-10.5a3.5 3.5 0 0 1 7 0v10.5" />
                        <path d="M3 13h7" />
                        <path d="M21 12v7" />
                    </svg>
                </button>

                <div
                    x-show="open"
                    x-anchor="$refs.button"
                    class="bg-white shadow-lg border border-gray-200 rounded-sm flex flex-col"
                >
                    <button
                        type="button"
                        @click="action.formatSelection('uppercase'), open = false"
                        class="w-full text-sm px-5 py-1 hover:bg-gray-100 hover:cursor-pointer"
                    >UPPERCASE
                    </button>
                    <button
                        type="button"
                        @click="action.formatSelection('lowercase'), open = false"
                        class="w-full text-sm px-5 py-1 hover:bg-gray-100 hover:cursor-pointer"
                    >lowercase
                    </button>
                    <button
                        type="button"
                        @click="action.formatSelection('titlecase'), open = false"
                        class="w-full text-sm px-5 py-1 hover:bg-gray-100 hover:cursor-pointer"
                    >Title Case
                    </button>
                </div>
            </div>

            {{-- FONT TYPESCRIPT --}}
            <button
                type="button"
                class="p-1 hover:bg-black/5 dark:hover:bg-white/5 text-black dark:text-white hover:cursor-pointer rounded-sm"
                @click="action.formatSelection('superscript')"
                title="{{ __('Superscript') }}"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="20"
                    height="20"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    class="icon icon-tabler icons-tabler-outline icon-tabler-superscript"
                >
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M5 7l8 10m-8 0l8 -10" />
                    <path d="M21 11h-4l3.5 -4a1.73 1.73 0 0 0 -3.5 -2" />
                </svg>
            </button>

            {{-- FONT SUPSCRIPT --}}
            <button
                type="button"
                class="p-1 hover:bg-black/5 dark:hover:bg-white/5 text-black dark:text-white hover:cursor-pointer rounded-sm"
                @click="action.formatSelection('subscript')"
                title="{{ __('Subscript') }}"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="20"
                    height="20"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    class="icon icon-tabler icons-tabler-outline icon-tabler-subscript"
                >
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M5 7l8 10m-8 0l8 -10" />
                    <path d="M21 20h-4l3.5 -4a1.73 1.73 0 0 0 -3.5 -2" />
                </svg>
            </button>

            {{-- CODE --}}
            <button
                type="button"
                class="p-1 hover:bg-black/5 dark:hover:bg-white/5 text-black dark:text-white hover:cursor-pointer rounded-sm"
                @click="action.formatSelection('code')"
                title="{{ __('Code Block') }}"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="20"
                    height="20"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    class="icon icon-tabler icons-tabler-outline icon-tabler-code"
                >
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M7 8l-4 4l4 4" />
                    <path d="M17 8l4 4l-4 4" />
                    <path d="M14 4l-4 16" />
                </svg>
            </button>

            {{-- TABLE --}}
            <button
                type="button"
                @click="action.insertTable()"
                class="p-1 hover:bg-black/5 dark:hover:bg-white/5 text-black dark:text-white hover:cursor-pointer rounded-sm"
                title="{{ __('Insert Table') }}"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="20"
                    height="20"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    class="icon icon-tabler icons-tabler-outline icon-tabler-table"
                >
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M3 5a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v14a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-14z" />
                    <path d="M3 10h18" />
                    <path d="M10 3v18" />
                </svg>
            </button>

            {{-- TEXT ALIGNMENT --}}
            <div x-data="{ open: false }" @click.outside="open = false">
                <button
                    type="button"
                    x-ref="button"
                    @click="open = ! open"
                    class="p-1 hover:bg-black/5 dark:hover:bg-white/5 text-black dark:text-white hover:cursor-pointer rounded-sm"
                    title="{{ __('Text Alignment') }}"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="20"
                        height="20"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        class="icon icon-tabler icons-tabler-outline icon-tabler-align-left"
                    >
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M4 6l16 0" />
                        <path d="M4 12l10 0" />
                        <path d="M4 18l14 0" />
                    </svg>
                </button>

                <div
                    x-show="open"
                    x-anchor="$refs.button"
                    class="bg-white shadow-lg border border-gray-200 rounded-sm flex flex-col"
                >
                    <button
                        type="button"
                        @click="action.alignLeft(), open = false"
                        class="w-full px-5 py-1 hover:bg-gray-100 hover:cursor-pointer"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="20"
                            height="20"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            class="icon icon-tabler icons-tabler-outline icon-tabler-align-left"
                        >
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M4 6l16 0" />
                            <path d="M4 12l10 0" />
                            <path d="M4 18l14 0" />
                        </svg>
                    </button>

                    <button
                        type="button"
                        @click="action.alignCenter(), open = false"
                        class="w-full px-5 py-1 hover:bg-gray-100 hover:cursor-pointer"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="20"
                            height="20"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            class="icon icon-tabler icons-tabler-outline icon-tabler-align-center"
                        >
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M4 6l16 0" />
                            <path d="M8 12l8 0" />
                            <path d="M6 18l12 0" />
                        </svg>
                    </button>

                    <button
                        type="button"
                        @click="action.alignRight(), open = false"
                        class="w-full px-5 py-1 hover:bg-gray-100 hover:cursor-pointer"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="20"
                            height="20"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            class="icon icon-tabler icons-tabler-outline icon-tabler-align-right"
                        >
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M4 6l16 0" />
                            <path d="M10 12l10 0" />
                            <path d="M6 18l14 0" />
                        </svg>
                    </button>

                    <button
                        type="button"
                        @click="open = false"
                        class="w-full px-5 py-1 hover:bg-gray-100 hover:cursor-pointer"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="20"
                            height="20"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            class="icon icon-tabler icons-tabler-outline icon-tabler-align-justified"
                        >
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M4 6l16 0" />
                            <path d="M4 12l16 0" />
                            <path d="M4 18l12 0" />
                        </svg>
                    </button>
                </div>
            </div>

            {{-- BULLETED LIST --}}
            <button
                type="button"
                @click="action.toggleList('ul', 'disc')"
                class="p-1 hover:bg-black/5 dark:hover:bg-white/5 text-black dark:text-white hover:cursor-pointer rounded-sm"
                title="{{ __('Bullet List') }}"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="20"
                    height="20"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    class="icon icon-tabler icons-tabler-outline icon-tabler-list"
                >
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M9 6l11 0" />
                    <path d="M9 12l11 0" />
                    <path d="M9 18l11 0" />
                    <path d="M5 6l0 .01" />
                    <path d="M5 12l0 .01" />
                    <path d="M5 18l0 .01" />
                </svg>
            </button>

            {{-- NUMBERED LIST --}}
            <button
                type="button"
                @click="action.toggleList('ol', 'decimal')"
                class="p-1 hover:bg-black/5 dark:hover:bg-white/5 text-black dark:text-white hover:cursor-pointer rounded-sm"
                title="{{ __('Numbered List') }}"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="20"
                    height="20"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    class="icon icon-tabler icons-tabler-outline icon-tabler-list-numbers"
                >
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M11 6h9" />
                    <path d="M11 12h9" />
                    <path d="M12 18h8" />
                    <path d="M4 16a2 2 0 1 1 4 0c0 .591 -.5 1 -1 1.5l-3 2.5h4" />
                    <path d="M6 10v-6l-2 2" />
                </svg>
            </button>

            {{-- LETTER LIST --}}
            <button
                type="button"
                @click="action.toggleList('ol', 'lower-alpha')"
                class="p-1 hover:bg-black/5 dark:hover:bg-white/5 text-black dark:text-white hover:cursor-pointer rounded-sm"
                title="{{ __('Letter List') }}"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="20"
                    height="20"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    class="icon icon-tabler icons-tabler-outline icon-tabler-list-letters"
                >
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M11 6h9" />
                    <path d="M11 12h9" />
                    <path d="M11 18h9" />
                    <path d="M4 10v-4.5a1.5 1.5 0 0 1 3 0v4.5" />
                    <path d="M4 8h3" />
                    <path d="M4 20h1.5a1.5 1.5 0 0 0 0 -3h-1.5h1.5a1.5 1.5 0 0 0 0 -3h-1.5v6z" />
                </svg>
            </button>

            {{-- LINK INSERT --}}
            <button
                type="button"
                @click.stop="link.insert()"
                class="p-1 hover:bg-black/5 dark:hover:bg-white/5 text-black dark:text-white hover:cursor-pointer rounded-sm"
                title="{{ __('Insert Link') }}"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="20"
                    height="20"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    class="icon icon-tabler icons-tabler-outline icon-tabler-link-plus"
                >
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M9 15l6 -6" />
                    <path d="M11 6l.463 -.536a5 5 0 0 1 7.072 0a4.993 4.993 0 0 1 -.001 7.072" />
                    <path d="M12.603 18.534a5.07 5.07 0 0 1 -7.127 0a4.972 4.972 0 0 1 0 -7.071l.524 -.463" />
                    <path d="M16 19h6" />
                    <path d="M19 16v6" />
                </svg>
            </button>

            {{-- FILE MANAGER INSERT --}}
            @if($withFilemanager)
                <livewire:filemanager :key="'file_manager_' . $uuid" />
            @endif

            {{-- IMAGE LINK INSERT --}}
            <div
                x-data="{ showModal: false, src: '', width: '200', height: '200', border: '1', radius: '0', lastSelection: null }"
            >
                <button
                    type="button"
                    @click="image.storeSelection(); image.showModal = true"
                    class="p-2 hover:bg-black/5 dark:hover:bg-white/5 text-black dark:text-white hover:cursor-pointer rounded-sm"
                    title="{{ __('Insert Image from URL') }}"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="24"
                        height="24"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        class="icon icon-tabler icons-tabler-outline icon-tabler-photo"
                    >
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M15 8h.01" />
                        <path d="M3 6a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v12a3 3 0 0 1 -3 3h-12a3 3 0 0 1 -3 -3v-12z" />
                        <path d="M3 16l5 -5c.928 -.893 2.072 -.893 3 0l5 5" />
                        <path d="M14 14l1 -1c.928 -.893 2.072 -.893 3 0l3 3" />
                    </svg>
                </button>

                <div
                    x-show="image.showModal"
                    class="fixed inset-0 flex items-center justify-center backdrop-blur-sm bg-opacity-50 z-1"
                >
                    <div
                        class="bg-white/10 backdrop-blur-4xl rounded-2xl shadow max-w-4xl w-full p-8 max-h-screen overflow-y-auto"
                    >
                        {{-- IMAGE INPUTS --}}
                        <div class="w-full my-4" x-data>
                            <label for="image_url" class="{{ config('x-form.label') }}">
                                Image URL <span class="text-xs text-red-500">*</span>
                            </label>

                            <input
                                id="image_url"
                                type="text"
                                x-model="image.src"
                                class="{{ config('x-form.input') }}"
                                placeholder="Enter the url link of the image you would like to insert..."
                            />

                            <!-- Informative hint -->
                            <p class="text-xs text-gray-500 mt-1">
                                Please use a <span class="font-medium">secure (https)</span> URL to a
                                <span class="font-medium">copyright-free</span> image.
                            </p>

                            <!-- Optional: Warning if input doesn't meet https requirement -->
                            <template x-if="image.src && !image.src.startsWith('https://')">
                                <p class="text-xs text-red-600 mt-1">
                                    ⚠️ URL must start with <span class="font-semibold">https://</span>
                                </p>
                            </template>
                        </div>

                        <div x-show="image.src">
                            <div class="w-full my-4">
                                <label
                                    for="image_alt_text"
                                    class="{{ config('x-form.label') }}"
                                >
                                    ALT Text <span class="text-xs text-red-500">*</span>
                                </label>

                                <input
                                    id="image_alt_text"
                                    type="text"
                                    x-model="image.alt"
                                    class="{{ config('x-form.input') }}"
                                    placeholder="Enter the alt title text for your image"
                                />
                            </div>

                            <div class="mt-4 w-full flex justify-center mb-4">
                                <img
                                    x-show="image.src"
                                    :src="image.src"
                                    :style="'float: '+image.float+'; width:'+image.width+'px;height:'+image.height+'px;border:'+image.borderWidth+'px solid '+image.borderColor+';border-radius:'+image.borderRadius+'px;'"
                                    class="shadow"
                                />
                            </div>

                            <div
                                x-data="{ range: 1, showRange: function(x) { this.range = x; }}"
                                class="w-full flex flex-col gap-2"
                            >
                                <div x-show="range == 1" class="flex items-center w-full gap-4">
                                    <!-- Width Slider and Input -->
                                    <div class="flex items-center flex-grow gap-2">
                                        <input
                                            type="range"
                                            id="image_width"
                                            min="0"
                                            max="1000"
                                            step="1"
                                            x-model="image.width"
                                            @input="image.changeImageDimensions('w', $el.value)"
                                            class="w-full h-2 accent-blue-500"
                                        />

                                        <div class="relative">
                                            <span class="absolute left-1 top-1/2 -translate-y-1/2 text-gray-400 text-xs">W</span>
                                            <input
                                                type="number"
                                                min="0"
                                                max="1000"
                                                step="1"
                                                x-model="image.width"
                                                @input="image.changeImageDimensions('w', $el.value)"
                                                class="pl-5 w-16 text-xs border border-gray-300 rounded-md py-1 px-1 text-gray-700 focus:ring-2 focus:ring-blue-400 focus:outline-none"
                                            />
                                        </div>
                                    </div>

                                    <!-- Height Slider and Input -->
                                    <div class="flex items-center flex-grow gap-2">
                                        <input
                                            type="range"
                                            id="image_height"
                                            min="0"
                                            max="1000"
                                            step="1"
                                            x-model="image.height"
                                            @input="image.changeImageDimensions('h', $el.value)"
                                            class="w-full h-2 accent-blue-500"
                                        />

                                        <div class="relative">
                                            <span class="absolute left-1 top-1/2 -translate-y-1/2 text-gray-400 text-xs">H</span>
                                            <input
                                                type="number"
                                                min="0"
                                                max="1000"
                                                step="1"
                                                x-model="image.height"
                                                @input="image.changeImageDimensions('h', $el.value)"
                                                class="pl-5 w-16 text-xs border border-gray-300 rounded-md py-1 px-1 text-gray-700 focus:ring-2 focus:ring-blue-400 focus:outline-none"
                                            />
                                        </div>
                                    </div>

                                    <!-- Aspect Ratio Toggle Button -->
                                    <button
                                        type="button"
                                        @click="image.changeConstraint()"
                                        class="w-8 h-8 flex items-center justify-center border border-gray-300 rounded-md hover:bg-gray-100 transition"
                                    >
                                        <!-- Locked Aspect -->
                                        <svg
                                            x-show="image.constraint"
                                            xmlns="http://www.w3.org/2000/svg"
                                            width="20"
                                            height="20"
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="2"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            class="stroke-gray-600"
                                        >
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M3 3m0 2a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v14a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2z" />
                                        </svg>

                                        <!-- Unlocked Aspect -->
                                        <svg
                                            x-show="!image.constraint"
                                            xmlns="http://www.w3.org/2000/svg"
                                            width="20"
                                            height="20"
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="2"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            class="stroke-gray-600"
                                        >
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M8 4h10a2 2 0 0 1 2 2v10m-.584 3.412a2 2 0 0 1 -1.416 .588h-12a2 2 0 0 1 -2 -2v-12c0 -.552 .224 -1.052 .586 -1.414" />
                                            <path d="M3 3l18 18" />
                                        </svg>
                                    </button>
                                </div>


                                <div
                                    x-show="range == 2"
                                    class="w-full flex items-center p-2 text-sm h-8 bg-transparent focus:outline-none"
                                >
                                    <input
                                        type="range"
                                        id="image_border"
                                        x-model="image.borderWidth"
                                        class="w-full"
                                        min="0"
                                        max="100"
                                        step="1"
                                    />

                                    <input
                                        type="number"
                                        min="0"
                                        max="1000"
                                        step="1"
                                        class="ml-2 w-12 text-xs text-gray-700 border border-gray-300 rounded px-1 py-0.5 focus:outline-none"
                                        x-model="image.borderWidth"
                                    />

                                    <input
                                        type="color"
                                        @input="image.setBorderColor($el.value)"
                                        class="rounded-md h-6 w-12"
                                    />
                                </div>

                                <div
                                    x-show="range == 3"
                                    class="grow flex items-center p-2 text-sm h-8 bg-transparent focus:outline-none"
                                >
                                    <input
                                        type="range"
                                        id="image_radius"
                                        x-model="image.borderRadius"
                                        class="w-full"
                                        min="0"
                                        max="100"
                                        step="1"
                                    />

                                    <input
                                        type="number"
                                        min="0"
                                        max="1000"
                                        step="1"
                                        class="ml-2 w-10 text-xs text-gray-700 border border-gray-300 rounded px-1 py-0.5 focus:outline-none"
                                        x-model="image.borderRadius"
                                    />
                                </div>

                                <div class="w-full flex justify-center gap-2">
                                    <button
                                        type="button"
                                        @click="showRange(1)"
                                        class="bg-gray-200 border border-gray-300/80 shadow hover:border-gray-300 text-black px-3 py-1 text-sm rounded-full min-w-20 hover:cursor-pointer"
                                    >
                                        Resize
                                    </button>

                                    <button
                                        type="button"
                                        @click="showRange(2)"
                                        class="bg-gray-200 border border-gray-300/80 shadow hover:border-gray-300 text-black px-3 py-1 text-sm rounded-full min-w-20 hover:cursor-pointer"
                                    >
                                        Border
                                    </button>

                                    <button
                                        type="button"
                                        @click="showRange(3)"
                                        class="bg-gray-200 border border-gray-300/80 shadow hover:border-gray-300 text-black px-3 py-1 text-sm rounded-full min-w-20 hover:cursor-pointer"
                                    >
                                        Border Radius
                                    </button>

                                    <button
                                        type="button"
                                        @click="showRange(4)"
                                        class="bg-gray-200 border border-gray-300/80 shadow hover:border-gray-300 text-black px-3 py-1 text-sm rounded-full min-w-20 hover:cursor-pointer"
                                    >
                                        Brightness
                                    </button>
                                </div>
                            </div>

                            <div class="w-full">
                                <label
                                    for="image_alignment"
                                    class="block text-xs font-medium mt-1 mb-1"
                                >Image placement:</label>
                                <select
                                    id="image_alignment"
                                    x-model="image.float"
                                    class="rounded-sm border border-gray-300 bg-transparent p-1 w-full text-sm h-7"
                                >
                                    <option value="none">None</option>
                                    <option value="left">Left</option>
                                    <option value="right">Right</option>
                                </select>
                            </div>
                        </div>


                        <button
                            type="button"
                            @click="image.insertImage()"
                            class="mt-2 bg-blue-600 border-2 border-blue-600 text-sm text-white font-medium px-3 py-1 rounded hover:cursor-pointer hover:opacity-80"
                            x-text="image.selectedImage ? 'Save Changes' : 'Insert Image'"
                        >
                        </button>
                        <button
                            type="button"
                            @click="image.showModal = false"
                            class="mt-2 border-2 border-gray-500 text-sm text-gray-500 font-medium px-3 py-1 rounded hover:cursor-pointer hover:opacity-80"
                        >
                            {{ __('Cancel') }}
                        </button>
                    </div>
                </div>
            </div>

            {{-- DECREASE INDENT --}}
            <button
                type="button"
                @click="action.changeIndent(false)"
                class="p-1 hover:bg-black/5 dark:hover:bg-white/5 text-black dark:text-white hover:cursor-pointer rounded-sm flex items-center gap-1 text-sm"
                title="{{ __('Decrease Indent') }}"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="20"
                    height="20"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    class="icon icon-tabler icons-tabler-outline icon-tabler-indent-decrease"
                >
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M20 6l-7 0" />
                    <path d="M20 12l-9 0" />
                    <path d="M20 18l-7 0" />
                    <path d="M8 8l-4 4l4 4" />
                </svg>
            </button>

            {{-- INCREASE INDENT --}}
            <button
                type="button"
                @click="action.changeIndent(true)"
                class="p-1 hover:bg-black/5 dark:hover:bg-white/5 text-black dark:text-white hover:cursor-pointer rounded-sm flex items-center gap-1 text-sm"
                title="{{ __('Increase Indent') }}"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="20"
                    height="20"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    class="icon icon-tabler icons-tabler-outline icon-tabler-indent-increase"
                >
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M20 6l-11 0" />
                    <path d="M20 12l-7 0" />
                    <path d="M20 18l-11 0" />
                    <path d="M4 8l4 4l-4 4" />
                </svg>
            </button>

            {{-- CLEAR HTML FORMAT --}}
            <button
                type="button"
                @click="clearFormatting"
                class="p-1 hover:bg-black/5 dark:hover:bg-white/5 text-black dark:text-white hover:cursor-pointer rounded-sm flex items-center gap-1 text-sm"
                title="{{ __('Clear formatting on the selected content') }}"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="20"
                    height="20"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    class="icon icon-tabler icons-tabler-outline icon-tabler-clear-formatting"
                >
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M17 15l4 4m0 -4l-4 4" />
                    <path d="M7 6v-1h11v1" />
                    <path d="M7 19l4 0" />
                    <path d="M13 5l-4 14" />
                </svg>
            </button>

        </div>

        {{-- EDITOR --}}
        <div
            id="{{ $uuid }}"
            class="p-4 min-h-60 overflow-auto outline-none bg-black/1 dark:bg-white/10 border dark:text-white border-black/5 dark:border-white/20 rounded-b-md"
            contenteditable="true"
            @input="content = ($event.target.innerHTML === '<br>') ? null : $event.target.innerHTML, $wire.set('{{ $model }}', content, false)"
            x-ref="editor"
        >
            {!! $content !!}
        </div>
    </div>
</div>
