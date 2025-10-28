@props(['icon_size' => 'size-5'])

<div
    x-data="editor('{{ $uuid }}', '{{ $model }}', $wire)"
    wire:ignore.self
>
    @if($label)
        <div class="{{ config('x-form.label') }}">{{ $label }}</div>
    @endif

    {{-- ACTIONS --}}
    <div
        class="flex flex-wrap space-x-2 items-center bg-black/5 dark:bg-white/10 px-3 border border-black/5 dark:border-white/20 border-b-0 shadow rounded-t-md"
        x-cloak
    >
        {{-- PARAGRAPH --}}
        <button
            type="button"
            @click="action.formatSelection('paragraph'), open = false"
            class="p-1 hover:bg-black/5 dark:hover:bg-white/5 text-black dark:text-white hover:cursor-pointer rounded-sm"
            title="{{ __('Paragraph Format') }}"
        >
            <svg
                xmlns="http://www.w3.org/2000/svg"
                class="{{ $icon_size }}"
                viewBox="0 -960 960 960"
                fill="currentColor"
            >
                <path d="M360-160v-240q-83 0-141.5-58.5T160-600q0-83 58.5-141.5T360-800h360v80h-80v560h-80v-560H440v560h-80Z" />
            </svg>
        </button>

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
                    viewBox="0 -960 960 960"
                    fill="currentColor"
                    class="{{ $icon_size }}"
                >
                    <path d="M420-160v-520H200v-120h560v120H540v520H420Z" />
                </svg>
            </button>

            <div
                x-show="open"
                x-anchor="$refs.button"
                class="bg-white shadow-lg border border-gray-200 rounded-sm flex flex-col"
            >
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

        {{-- TEXT CASE CHANGE --}}
        <div x-data="{ open: false }" @click.outside="open = false">
            <button
                type="button"
                x-ref="button"
                @click="open = ! open"
                class="p-1 hover:bg-black/5 dark:hover:bg-white/5 text-black dark:text-white hover:cursor-pointer rounded-sm"
                title="{{ __('Text Cases') }}"
            >
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor" class="size-6">
                    <path d="m131-252 165-440h79l165 440h-76l-39-112H247l-40 112h-76Zm139-176h131l-64-182h-4l-63 182Zm395 186q-51 0-81-27.5T554-342q0-44 34.5-72.5T677-443q23 0 45 4t38 11v-12q0-29-20.5-47T685-505q-23 0-42 9.5T610-468l-47-35q24-29 54.5-43t68.5-14q69 0 103 32.5t34 97.5v178h-63v-37h-4q-14 23-38 35t-53 12Zm12-54q35 0 59.5-24t24.5-56q-14-8-33.5-12.5T689-393q-32 0-50 14t-18 37q0 20 16 33t40 13Z" />
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
                    class="{{ $icon_size }}"
                    viewBox="0 -960 960 960"
                    fill="currentColor"
                >
                    <path d="M280-160v-520H80v-120h520v120H400v520H280Zm360 0v-320H520v-120h360v120H760v320H640Z" />
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
                viewBox="0 -960 960 960"
                fill="currentColor"
                class="{{ $icon_size }}"
            >
                <path d="M272-200v-560h221q65 0 120 40t55 111q0 51-23 78.5T602-491q25 11 55.5 41t30.5 90q0 89-65 124.5T501-200H272Zm121-112h104q48 0 58.5-24.5T566-372q0-11-10.5-35.5T494-432H393v120Zm0-228h93q33 0 48-17t15-38q0-24-17-39t-44-15h-95v109Z" />
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
                class="{{ $icon_size }}"
                viewBox="0 -960 960 960"
                fill="currentColor"
            >
                <path d="M200-200v-100h160l120-360H320v-100h400v100H580L460-300h140v100H200Z" />
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
                class="{{ $icon_size }}"
                viewBox="0 -960 960 960"
                fill="currentColor"
            >
                <path d="M200-120v-80h560v80H200Zm280-160q-101 0-157-63t-56-167v-330h103v336q0 56 28 91t82 35q54 0 82-35t28-91v-336h103v330q0 104-56 167t-157 63Z" />
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
                class="{{ $icon_size }}"
                viewBox="0 -960 960 960"
                fill="currentColor"
            >
                <path d="M80-400v-80h800v80H80Zm340-160v-120H200v-120h560v120H540v120H420Zm0 400v-160h120v160H420Z" />
            </svg>
        </button>

        {{-- FONT SUPERSCRIPT --}}
        <button
            type="button"
            class="p-1 hover:bg-black/5 dark:hover:bg-white/5 text-black dark:text-white hover:cursor-pointer rounded-sm"
            @click="action.formatSelection('superscript')"
            title="{{ __('Superscript') }}"
        >
            <svg
                xmlns="http://www.w3.org/2000/svg"
                class="{{ $icon_size }}"
                viewBox="0 -960 960 960"
                fill="currentColor"
            >
                <path d="M760-600v-80q0-17 11.5-28.5T800-720h80v-40H760v-40h120q17 0 28.5 11.5T920-760v40q0 17-11.5 28.5T880-680h-80v40h120v40H760ZM235-160l185-291-172-269h106l124 200h4l123-200h107L539-451l186 291H618L482-377h-4L342-160H235Z" />
            </svg>
        </button>

        {{-- FONT SUBSCRIPT --}}
        <button
            type="button"
            class="p-1 hover:bg-black/5 dark:hover:bg-white/5 text-black dark:text-white hover:cursor-pointer rounded-sm"
            @click="action.formatSelection('subscript')"
            title="{{ __('Subscript') }}"
        >
            <svg
                xmlns="http://www.w3.org/2000/svg"
                class="{{ $icon_size }}"
                viewBox="0 -960 960 960"
                fill="currentColor"
            >
                <path d="M760-160v-80q0-17 11.5-28.5T800-280h80v-40H760v-40h120q17 0 28.5 11.5T920-320v40q0 17-11.5 28.5T880-240h-80v40h120v40H760Zm-525-80 185-291-172-269h106l124 200h4l123-200h107L539-531l186 291H618L482-457h-4L342-240H235Z" />
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
                class="{{ $icon_size }}"
                viewBox="0 -960 960 960"
                fill="currentColor"
            >
                <path d="m384-336 56-57-87-87 87-87-56-57-144 144 144 144Zm192 0 144-144-144-144-56 57 87 87-87 87 56 57ZM200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h560q33 0 56.5 23.5T840-760v560q0 33-23.5 56.5T760-120H200Zm0-80h560v-560H200v560Zm0-560v560-560Z" />
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
                    class="{{ $icon_size }}"
                    viewBox="0 -960 960 960"
                    fill="currentColor"
                >
                    <path d="M80 0v-160h800V0H80Zm140-280 210-560h100l210 560h-96l-50-144H368l-52 144h-96Zm176-224h168l-82-232h-4l-82 232Z" />
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
                    class="{{ $icon_size }}"
                    viewBox="0 -960 960 960"
                    fill="currentColor"
                >
                    <path d="m247-904 57-56 343 343q23 23 23 57t-23 57L457-313q-23 23-57 23t-57-23L153-503q-23-23-23-57t23-57l190-191-96-96Zm153 153L209-560h382L400-751Zm360 471q-33 0-56.5-23.5T680-360q0-21 12.5-45t27.5-45q9-12 19-25t21-25q11 12 21 25t19 25q15 21 27.5 45t12.5 45q0 33-23.5 56.5T760-280ZM80 0v-160h800V0H80Z" />
                </svg>
            </button>
        </div>

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
                    class="{{ $icon_size }}"
                    viewBox="0 -960 960 960"
                    fill="currentColor"
                >
                    <path d="M160-200v-80h400v80H160Zm0-160v-80h640v80H160Zm0-160v-80h640v80H160Zm0-160v-80h640v80H160Z" />
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
                        class="{{ $icon_size }}"
                        viewBox="0 -960 960 960"
                        fill="currentColor"
                    >
                        <path d="M120-120v-80h720v80H120Zm0-160v-80h480v80H120Zm0-160v-80h720v80H120Zm0-160v-80h480v80H120Zm0-160v-80h720v80H120Z" />
                    </svg>
                </button>

                <button
                    type="button"
                    @click="action.alignCenter(), open = false"
                    class="w-full px-5 py-1 hover:bg-gray-100 hover:cursor-pointer"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="{{ $icon_size }}"
                        viewBox="0 -960 960 960"
                        fill="currentColor"
                    >
                        <path d="M120-120v-80h720v80H120Zm160-160v-80h400v80H280ZM120-440v-80h720v80H120Zm160-160v-80h400v80H280ZM120-760v-80h720v80H120Z" />
                    </svg>
                </button>

                <button
                    type="button"
                    @click="action.alignRight(), open = false"
                    class="w-full px-5 py-1 hover:bg-gray-100 hover:cursor-pointer"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="{{ $icon_size }}"
                        viewBox="0 -960 960 960"
                        fill="currentColor"
                    >
                        <path d="M120-760v-80h720v80H120Zm240 160v-80h480v80H360ZM120-440v-80h720v80H120Zm240 160v-80h480v80H360ZM120-120v-80h720v80H120Z" />
                    </svg>
                </button>
            </div>
        </div>

        {{-- DECREASE INDENT --}}
        {{--            <button--}}
        {{--                type="button"--}}
        {{--                @click="action.changeIndent(false)"--}}
        {{--                class="p-1 hover:bg-black/5 dark:hover:bg-white/5 text-black dark:text-white hover:cursor-pointer rounded-sm flex items-center gap-1 text-sm"--}}
        {{--                title="{{ __('Decrease Indent') }}"--}}
        {{--            >--}}
        {{--                <svg xmlns="http://www.w3.org/2000/svg" class="{{ $icon_size }}" viewBox="0 -960 960 960" fill="currentColor"><path d="M120-120v-80h720v80H120Zm320-160v-80h400v80H440Zm0-160v-80h400v80H440Zm0-160v-80h400v80H440ZM120-760v-80h720v80H120Zm160 440L120-480l160-160v320Z"/></svg>--}}
        {{--            </button>--}}

        {{-- INCREASE INDENT --}}
        {{--            <button--}}
        {{--                type="button"--}}
        {{--                @click="action.changeIndent(true)"--}}
        {{--                class="p-1 hover:bg-black/5 dark:hover:bg-white/5 text-black dark:text-white hover:cursor-pointer rounded-sm flex items-center gap-1 text-sm"--}}
        {{--                title="{{ __('Increase Indent') }}"--}}
        {{--            >--}}
        {{--                <svg xmlns="http://www.w3.org/2000/svg" class="{{ $icon_size }}" viewBox="0 -960 960 960" fill="currentColor"><path d="M120-120v-80h720v80H120Zm320-160v-80h400v80H440Zm0-160v-80h400v80H440Zm0-160v-80h400v80H440ZM120-760v-80h720v80H120Zm0 440v-320l160 160-160 160Z"/></svg>--}}
        {{--            </button>--}}

        {{-- BULLETED LIST --}}
        <button
            type="button"
            @click="action.toggleList('ul', 'disc')"
            class="p-1 hover:bg-black/5 dark:hover:bg-white/5 text-black dark:text-white hover:cursor-pointer rounded-sm"
            title="{{ __('Bullet List') }}"
        >
            <svg
                xmlns="http://www.w3.org/2000/svg"
                class="{{ $icon_size }}"
                viewBox="0 -960 960 960"
                fill="currentColor"
            >
                <path d="M360-200v-80h480v80H360Zm0-240v-80h480v80H360Zm0-240v-80h480v80H360ZM200-160q-33 0-56.5-23.5T120-240q0-33 23.5-56.5T200-320q33 0 56.5 23.5T280-240q0 33-23.5 56.5T200-160Zm0-240q-33 0-56.5-23.5T120-480q0-33 23.5-56.5T200-560q33 0 56.5 23.5T280-480q0 33-23.5 56.5T200-400Zm0-240q-33 0-56.5-23.5T120-720q0-33 23.5-56.5T200-800q33 0 56.5 23.5T280-720q0 33-23.5 56.5T200-640Z" />
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
                class="{{ $icon_size }}"
                viewBox="0 -960 960 960"
                fill="currentColor"
            >
                <path d="M120-80v-60h100v-30h-60v-60h60v-30H120v-60h120q17 0 28.5 11.5T280-280v40q0 17-11.5 28.5T240-200q17 0 28.5 11.5T280-160v40q0 17-11.5 28.5T240-80H120Zm0-280v-110q0-17 11.5-28.5T160-510h60v-30H120v-60h120q17 0 28.5 11.5T280-560v70q0 17-11.5 28.5T240-450h-60v30h100v60H120Zm60-280v-180h-60v-60h120v240h-60Zm180 440v-80h480v80H360Zm0-240v-80h480v80H360Zm0-240v-80h480v80H360Z" />
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
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round"
                class="{{ $icon_size }} icon-tabler icons-tabler-outline icon-tabler-list-letters"
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

        {{-- TABLE --}}
        <button
            type="button"
            @click="action.insertTable()"
            class="p-1 hover:bg-black/5 dark:hover:bg-white/5 text-black dark:text-white hover:cursor-pointer rounded-sm"
            title="{{ __('Insert Table') }}"
        >
            <svg
                xmlns="http://www.w3.org/2000/svg"
                class="{{ $icon_size }}"
                viewBox="0 -960 960 960"
                fill="currentColor"
            >
                <path d="M200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h560q33 0 56.5 23.5T840-760v560q0 33-23.5 56.5T760-120H200Zm240-240H200v160h240v-160Zm80 0v160h240v-160H520Zm-80-80v-160H200v160h240Zm80 0h240v-160H520v160ZM200-680h560v-80H200v80Z" />
            </svg>
        </button>

        {{-- LINK INSERT --}}
        <button
            type="button"
            x-ref="linkBtn"
            @click.stop="link.showPopup($event)"
            class="p-1 hover:bg-black/5 dark:hover:bg-white/5 text-black dark:text-white hover:cursor-pointer rounded-sm"
            title="{{ __('Insert Link') }}"
        >
            <svg
                xmlns="http://www.w3.org/2000/svg"
                class="{{ $icon_size }}"
                viewBox="0 -960 960 960"
                fill="currentColor"
            >
                <path d="M680-160v-120H560v-80h120v-120h80v120h120v80H760v120h-80ZM440-280H280q-83 0-141.5-58.5T80-480q0-83 58.5-141.5T280-680h160v80H280q-50 0-85 35t-35 85q0 50 35 85t85 35h160v80ZM320-440v-80h320v80H320Zm560-40h-80q0-50-35-85t-85-35H520v-80h160q83 0 141.5 58.5T880-480Z" />
            </svg>
        </button>

        {{-- IMAGE LINK INSERT --}}
        <div>
            <button
                type="button"
                @click="image.storeSelection(); image.showModal = true"
                class="p-2 hover:bg-black/5 dark:hover:bg-white/5 text-black dark:text-white hover:cursor-pointer rounded-sm"
                title="{{ __('Insert Image from URL') }}"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="{{ $icon_size }}"
                    viewBox="0 -960 960 960"
                    fill="currentColor"
                >
                    <path d="M200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h560q33 0 56.5 23.5T840-760v560q0 33-23.5 56.5T760-120H200Zm0-80h560v-560H200v560Zm40-80h480L570-480 450-320l-90-120-120 160Zm-40 80v-560 560Z" />
                </svg>
            </button>

            <div
                x-show="image.showModal"
                class="fixed inset-0 flex items-center justify-center backdrop-blur-sm bg-opacity-50 z-1"
                wire:ignore
                x-cloak
            >
                <div
                    class="bg-white/80 dark:bg-black/90 backdrop-blur-4xl rounded-2xl shadow max-w-4xl w-full p-8 max-h-screen overflow-y-auto"
                >
                    {{-- IMAGE INPUTS --}}
                    <div class="w-full my-4" x-data>
                        <label for="image_url" class="{{ config('x-form.label') }}">
                            Image URL <span class="text-xs text-red-500">*</span>
                        </label>

                        <input
                            id="{{ $uuid }}_image_url"
                            type="text"
                            x-model="image.src"
                            @input="image.init()"
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
                                id="{{ $uuid }}_image_alt_text"
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
                                :style="{
                                      float: image.float,
                                      width: image.width+'px',
                                      height: image.height+'px',
                                      border: image.borderWidth+'px solid '+image.borderColor,
                                      borderRadius: image.borderRadius+'px',
                                      opacity: image.opacity
                                    }"
                                class="shadow"
                            />
                        </div>

                        <div
                            class="w-full flex flex-col gap-2"
                        >
                            <div x-show="image.range == 1" class="flex items-center w-full gap-4">
                                <!-- Width Slider and Input -->
                                <div class="flex items-center flex-grow gap-2">
                                    <input
                                        type="range"
                                        id="{{ $uuid }}_image_width"
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
                                        id="{{ $uuid }}_image_height"
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
                                x-show="image.range == 2"
                                class="w-full flex items-center p-2 text-sm h-8 bg-transparent focus:outline-none"
                            >
                                <input
                                    type="range"
                                    id="{{ $uuid }}_image_border"
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
                                x-show="image.range == 3"
                                class="grow flex items-center p-2 text-sm h-8 bg-transparent focus:outline-none"
                            >
                                <input
                                    type="range"
                                    id="{{ $uuid }}_image_radius"
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

                            <div
                                x-show="image.range == 4"
                                class="grow flex items-center p-2 text-sm h-8 bg-transparent focus:outline-none"
                            >
                                <input
                                    type="range"
                                    id="{{ $uuid }}_image_brightness"
                                    x-model="image.opacity"
                                    class="w-full"
                                    min="0"
                                    max="1"
                                    step="0.1"
                                />
                            </div>

                            <div class="w-full flex justify-center gap-2">
                                <button
                                    type="button"
                                    @click="image.setRange(1)"
                                    class="bg-gray-200 border border-gray-300/80 shadow hover:border-gray-300 text-black px-3 py-1 text-sm rounded-full min-w-20 hover:cursor-pointer"
                                >
                                    Resize
                                </button>

                                <button
                                    type="button"
                                    @click="image.setRange(2)"
                                    class="bg-gray-200 border border-gray-300/80 shadow hover:border-gray-300 text-black px-3 py-1 text-sm rounded-full min-w-20 hover:cursor-pointer"
                                >
                                    Border
                                </button>

                                <button
                                    type="button"
                                    @click="image.setRange(3)"
                                    class="bg-gray-200 border border-gray-300/80 shadow hover:border-gray-300 text-black px-3 py-1 text-sm rounded-full min-w-20 hover:cursor-pointer"
                                >
                                    Border Radius
                                </button>

                                <button
                                    type="button"
                                    @click="image.setRange(4)"
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
                                id="{{ $uuid }}_image_alignment"
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
                        @click="$dispatch('insertImage')"
                        class="mt-2 bg-blue-600 border-2 border-blue-600 text-sm text-white font-medium px-3 py-1 rounded hover:cursor-pointer hover:opacity-80"
                        x-text="image.selectedImage ? 'Update Image' : 'Insert Image'"
                    >
                    </button>

                    <button
                        type="button"
                        @click="image.closeModal()"
                        class="mt-2 border-2 border-gray-500 text-sm text-gray-500 font-medium px-3 py-1 rounded hover:cursor-pointer hover:opacity-80"
                    >
                        {{ __('Cancel') }}
                    </button>

                    <template x-if="image.selectedImage">
                        <button
                            type="button"
                            @click="image.remove()"
                            class="mt-2 border-2 border-red-500 text-sm text-red-500 font-medium px-3 py-1 rounded hover:cursor-pointer hover:opacity-80"
                        >
                            {{ __('Remove Image') }}
                        </button>
                    </template>
                </div>
            </div>
        </div>

        {{-- FILE MANAGER INSERT --}}
        @if($withFilemanager)
            <livewire:filemanager :key="'file_manager_' . $uuid" />
        @endif

        {{-- CLEAR HTML FORMAT --}}
        <button
            type="button"
            @click="clearFormatting"
            class="p-1 hover:bg-black/5 dark:hover:bg-white/5 text-black dark:text-white hover:cursor-pointer rounded-sm flex items-center gap-1 text-sm"
            title="{{ __('Clear formatting on the selected content') }}"
        >
            <svg
                xmlns="http://www.w3.org/2000/svg"
                class="{{ $icon_size }}"
                viewBox="0 -960 960 960"
                fill="currentColor"
            >
                <path d="m528-546-93-93-121-121h486v120H568l-40 94ZM792-56 460-388l-80 188H249l119-280L56-792l56-56 736 736-56 56Z" />
            </svg>
        </button>
    </div>

    {{-- EDITOR --}}
    <div>
        <div
            id="{{ $uuid }}"
            class="p-4 min-h-60 overflow-auto outline-none bg-black/1 dark:bg-white/10 border dark:text-white border-black/5 dark:border-white/20 rounded-b-md [&>img]:hover:cursor-grab [&>img]:active:cursor-grabbing"
            contenteditable="true"
            @input="content = ($event.target.innerHTML === '<br>') ? null : $event.target.innerHTML, $wire.set('{{ $model }}', content, false)"
            x-ref="editor"
        >
            {!! $content !!}
        </div>
    </div>

    @error($rule)
        <div class="{{ config('x-form.error') }}">{!! $message !!}</div>
    @enderror
</div>
