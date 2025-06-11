<div
    id="{{ $uuid }}"
    wire:key="{{ $uuid }}"
    @if($required)
        @click="validateDropdown('{{ $model }}', $wire.get('{{ $model }}'), '{{ $uuid }}')"
    @endif
>
    @if($label)
        <x-form.label
            :label="$label"
            :model="$model"
            :modifier="$live"
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
            show_item(el) {
                return this.search === '' || el.textContent.toLowerCase().includes(this.search.toLowerCase());
            }
         }"
        @keyup.escape="opened = false"
    >
        <button
            type="button"
            x-ref="dropdown"
            @click="opened = true"
            {{
                $attributes->class([
                    config('x-form.dropdown'),
                    config('x-form.invalid') => $errors->has($rule)
                ])->merge([
                    'id' => 'btn_' . $uuid,
                    'class' => 'items-center gap-2 px-3!'
                ])
            }}
            :class="{'opacity-80! border-primary': opened}"
            @if(!$searchable) @click.outside="opened = false" @endif
        >
            @if($icon)
                @if(str($icon)->contains(['<i', '<svg', '<img', '<span']))
                    {{-- Render as HTML (SVG, IMG, custom HTML, etc.) --}}
                    {!! $icon !!}
                @else
                    {{-- Render as an <i> tag with class --}}
                    <i class="{{ $icon }} me-1"></i>
                @endif
            @endif

            <span
                class="capitalize bg-transparent! border-none! truncate w-full flex items-center pe-4"
                x-html="title"
            ></span>

            <template x-if="title != '-'">
                <svg xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"
                     @click.stop="title = '-', $wire.set('{{ $model }}', '', {{ $live ? 'true' : 'false' }}), opened = false, search='' @if($required), validateDropdown('{{ $model }}', $wire.get('{{ $model }}'), '{{ $uuid }}')@endif"
                ><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M18 6l-12 12" /><path d="M6 6l12 12" /></svg>
            </template>

            <template x-if="title == '-'">
                <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-chevron-down"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 9l6 6l6 -6" /></svg>
            </template>
        </button>

        {{-- Search input is outside dropdown --}}
        @if($searchable && !$inline)
            <input
                x-ref="dropdown"
                type="search"
                class="form-control opacity-95 absolute top-0 left-0"
                x-model="search"
                x-show="opened"
                @click.outside="opened = false"
                @keyup.escape.stop
            />
        @endif

        <div
            class="scrollbar-thin min-w-48 py-2 px-0 text-sm text-left list-none rounded-md shadow-lg bg-white bg-clip-padding border-gray-400 text-gray-500 dark:text-dark-100 dark:bg-dark absolute w-full overflow-x-hidden overflow-y-auto"
            aria-labelledby="{{ 'btn_' . $uuid }}"
            style="min-width: {{ $minWidth }}; max-height: {{ $maxHeight }}; z-index: 1040;"
            x-show="opened"
            x-anchor.bottom-start="$refs.dropdown"
            x-cloak
        >
            {{-- Search is inside dropdown --}}
            @if($searchable && $inline)
                <div class="m-0">
                    <input
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

            <a
                wire:key="{{ "dropdown-$uuid" }}"
                href="javascript:void(0);"
                class="flex items-center w-full text-left gap-3 pl-4 py-2 clear-both font-normal cursor-pointer whitespace-nowrap text-gray-500 dark:text-dark-100 border-none rounded-none hover:opacity-80 hover:bg-gray-100"
                x-effect="if (!$wire.get('{{ $model }}')) { title =  '-' }"
                @click="title = '-', $wire.set('{{ $model }}', '', {{ $live ? 'true' : 'false' }}), opened = false, search=''"
            >
                -
            </a>

            @foreach ($list as $list_title => $id)
                <a
                    href="javascript:void(0);"
                    class="flex items-center w-full text-left gap-3 pl-4 py-2 clear-both font-normal cursor-pointer whitespace-nowrap text-gray-500 dark:text-dark-100 border-none rounded-none hover:opacity-80 hover:bg-gray-100 capitalize"
                    :class="{'disabled': $wire.get('{{ $model }}') == '{{ $id }}'}"
                    x-cloak
                    x-show="show_item($el)"
                    x-effect="if ($wire.get('{{ $model }}') == '{{ $id }}') {title =  @js($list_title)}"
                    @click="title = @js($list_title), $wire.set('{{ $model }}', '{{ $id }}', {{ $live ? 'true' : 'false' }}), opened = false, search=''"
                    wire:key="{{ "drp-$uuid-$id" }}"
                >
                    {!! $list_title !!}
                </a>
            @endforeach
        </div>

        @error($rule)
        <div class="{{ config('x-form.error') }}">{!! $message !!}</div>
        @enderror
    </div>
</div>
