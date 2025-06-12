<div x-data="{
    isDragging: false,
    files: [],
    handleDrop(event) {
        this.isDragging = false;
        const droppedFiles = Array.from(event.dataTransfer.files);
        this.files = droppedFiles;
        this.$refs.file.files = event.dataTransfer.files;
        this.$refs.file.dispatchEvent(new Event('change', { bubbles: true }));
    },
    handleFileChange(event) {
        this.files = Array.from(event.target.files);
    }
}">
    @if($dropzone)
        <div class="flex items-center justify-center w-full">
            <label
                for="{{ $uuid }}"
                x-on:dragover.prevent="isDragging = true"
                x-on:dragleave.prevent="isDragging = false"
                x-on:drop.prevent="handleDrop"
                :class="{ 'bg-light/20 dark:bg-black/20 border-primary': isDragging }"
                class="flex flex-col items-center justify-center w-full h-64 border-2 border-light border-dashed rounded-lg cursor-pointer bg-transparent hover:bg-light/10 dark:hover:bg-black/10"
            >
                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                    <svg
                        class="w-8 h-8 mb-4 text-dark dark:text-light"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 20 16"
                    >
                        <path
                            stroke="currentColor"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"
                        />
                    </svg>
                    <p class="bold text-lg">{{ $label }}</p>
                    <template x-if="files.length === 0">
                        <p class="mb-2 text-sm text-dark dark:text-light">
                            <span class="font-semibold">Click to upload</span> or drag and drop
                        </p>
                    </template>

                    <template x-if="files.length > 0">
                        <ul class="mb-2 text-sm text-dark dark:text-light space-y-1">
                            <template x-for="file in files" :key="file.name">
                                <li x-text="file.name"></li>
                            </template>
                        </ul>
                    </template>
                    <p class="text-xs text-dark dark:text-light">{{ $help }}</p>
                </div>
                @elseif($icon || $svg)
                    <button type="button" class="px-3 py-2 bg-gray-200 rounded-md flex items-center gap-2 cursor-pointer hover:opacity-80" x-on:click="$refs.file.click()" aria-label="{{ __('Upload Photo') }}">
                        @if ($icon)
                            <i class="{{ $icon }}"></i>
                        @else
                            {!! $svg !!}
                        @endif

                        {{ $label ?? null }}
                    </button>
                @elseif($label)
                    <x-form.label
                        :for="$uuid"
                        :label="$label"
                        :model="$model"
                        :modifier="$modifier"
                        :tooltip="$tooltip"
                        :help="$help"
                        :required="$required"
                    />
                @else
                    {{ $slot }}
                @endif

                <input
                    x-ref="file"
                    x-on:change="handleFileChange"
                    type="file"
                    {{
                        $attributes
                        ->class([
                            'w-full mt-2 file:cursor-pointer text-sm text-light file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-primary-50 dark:file:bg-dark-700 file:text-primary-700 dark:file:text-white hover:file:bg-primary-100 dark:hover:file:bg-dark-600' => !$dropzone && !$icon,
                            'hidden' => $dropzone || $icon || $svg
                            ])
                        ->merge([
                            'id' => $uuid,
                            'name' => $name,
                            'wire:model' . $modifier => $model,
                            'wire:key' => $uuid,
                        ])

                    }}

                    @if($tooltip && !$label)
                        x-tooltip="{{ $tooltip }}"
                    @endif

                    {{ $multiple }}
                />

                @if($dropzone)
            </label>
        </div>
    @endif
</div>

{{ $append }}
