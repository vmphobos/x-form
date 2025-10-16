@php
    if (isset($this->$model) && $this->$model) {
        $title = Arr::get(array_flip($list), $this->$model);
    }
@endphp

<div
    id="{{ $uuid }}"
    wire:key="{{ $uuid }}"
    @if($required)
        @click="validateDropdown('{{ $model }}', $wire.get('{{ $model }}') ?? model, '{{ $uuid }}')"
    @endif
>
    @if($label)
        <x-form.label
            :label="$label"
            :model="$model"
            :modifier="$attributes->has('live') || $attributes->has('blur')"
            :tooltip="$tooltip"
            :help="$help"
            :required="$required"
        />
    @endif

    <div
        class="relative"
        x-data="{
            title: '{{ $title }}',
            search: '',
            opened: false,
            model: '',
            show_item(el) {
                return this.search === '' || el.textContent.toLowerCase().includes(this.search.toLowerCase());
            },
            selectItem(id, title) {
                this.model = id;
                this.title = title;
                this.opened = false;

                if (typeof $wire !== 'undefined') {
                    $wire.set('{{ $model }}', id, {{ $live ? 'true' : 'false' }});
                }

                if ({{ $required ? 'true' : 'false' }}) {
                    validateDropdown('{{ $model }}', this.model, '{{ $uuid }}');
                }
            }
         }"
        @keyup.escape="opened = false"
        @if($searchable)
            x-init="$watch('opened', value => {
                if (value) $nextTick(() => $refs.searchInput?.focus())
            })"
        @endif
    >
        <button
            type="button"
            x-ref="dropdown"
            @click="opened = true"
            {{
                $attributes->class([
                    config('x-form.dropdown.input'),
                    config('x-form.invalid') => $errors->has($rule)
                ])->merge([
                    'id' => 'btn_' . $uuid,
                    'class' => 'items-center gap-2 px-3!'
                ])
            }}
            :class="{'opacity-0': opened}"
            @if(!$searchable) @click.outside="opened = false" @endif
        >
            @if($icon)
                @if(str($icon)->contains(['<i', '<svg', '<img', '<span']))
                    {!! $icon !!}
                @else
                    <i class="{{ $icon }} me-1"></i>
                @endif
            @endif

            <span
                class="capitalize text-sm bg-transparent! border-none! truncate w-full flex items-center pe-4"
                x-html="title"
            ></span>

            <template x-if="title != '-'">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    class="{{ config('x-form.icon_size') }} lucide lucide-x-icon lucide-x"
                    @click.stop="title = '-', model = '', opened = false, search=''; if (typeof $wire !== 'undefined') { $wire.set('{{ $model }}', '', {{ $live ? 'true' : 'false' }}) }"
                >
                    <path d="M18 6 6 18" />
                    <path d="m6 6 12 12" />
                </svg>
            </template>

            <template x-if="title == '-'">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    class="{{ config('x-form.icon_size') }} lucide lucide-chevron-down-icon lucide-chevron-down"
                >
                    <path d="m6 9 6 6 6-6" />
                </svg>
            </template>
        </button>

        {{-- Search input is outside dropdown --}}
        @if($searchable && !$inline)
            <input
                x-ref="searchInput"
                type="search"
                {{ $attributes->class([
                        config('x-form.dropdown.input'),
                        config('x-form.invalid') => $errors->has($rule),
                        'opacity-95 absolute top-0 left-0'
                    ])
                 }}
                x-model="search"
                x-show="opened"
                @click.outside="opened = false"
                @keyup.escape.stop="opened = false"
            />
        @endif

        <div
            class="scrollbar-thin min-w-48 py-2 px-0 text-sm text-left list-none rounded-md shadow-lg backdrop-blur-md bg-white/30 dark:bg-white/10 bg-clip-padding border-gray-400 text-gray-500 dark:text-dark-100 absolute w-full overflow-x-hidden overflow-y-auto"
            aria-labelledby="{{ 'btn_' . $uuid }}"
            style="min-width: {{ $minWidth }}; max-height: {{ $maxHeight }}; z-index: 1040;"
            x-show="opened"

            x-cloak
        >
            {{-- Search is inside dropdown --}}
            @if($searchable && $inline)
                <div class="m-0">
                    <input
                        x-ref="searchInput"
                        type="search"
                        class="form-control opacity-90"
                        style="border-radius: 0;"
                        x-model="search"
                        x-show="opened"
                        @click.outside="opened = false"
                        @keyup.escape.stop
                        placeholder="search..."
                    />
                </div>
            @endif

            <button
                type="button"
                class="{{ config('x-form.dropdown.item') }}"
                @click="selectItem('', '-')"
            >
                -
            </button>

            @foreach ($list as $list_title => $id)
                <button
                    type="button"
                    class="{{ config('x-form.dropdown.item') }}"
                    :class="{'disabled': model == '{{ $id }}'}"
                    x-cloak
                    x-show="show_item($el)"
                    @click="selectItem('{{ $id }}', @js($list_title))"
                >
                    {!! $list_title !!}
                </button>
            @endforeach
        </div>

        @error($rule)
        <div class="{{ config('x-form.error') }}">{!! $message !!}</div>
        @enderror
    </div>
</div>
