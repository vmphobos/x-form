<div
    x-data="{
        open: false,
        files: @entangle('files'),
        image_selected: false,
        current_path: @entangle('current_path'),
        confirmAndCreateFolder() {
            const folder_name = prompt('Enter the folder name:');

            if (folder_name && folder_name.trim() !== '') {
                $wire.set('folder_name', folder_name.trim());
            }
        },
    }"
    wire:ignore
>
    <button
        type="button"
        @click="image.storeSelection(); open = true; $wire.loadGallery()"
        class="p-2 hover:bg-black/5 dark:hover:bg-white/5 text-black dark:text-white hover:cursor-pointer rounded-sm"
        x-tooltip="Open Media Manager"
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
            class="icon icon-tabler icons-tabler-outline icon-tabler-folder"
        >
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <path d="M5 4h4l3 3h7a2 2 0 0 1 2 2v8a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-11a2 2 0 0 1 2 -2" />
        </svg>
    </button>

    <!-- Modal for File Manager -->
    <div class="fixed inset-0 backdrop-blur-sm flex justify-center items-center z-100" x-show="open" x-cloak>
        <div class="relative bg-white p-4 rounded-lg border border-gray-200 shadow-lg w-3/4 min-h-2/4">
            <!-- Loading Spinner -->
            <div
                wire:loading.class.remove="hidden"
                class="hidden opacity-80 absolute inset-0 flex gap-2 items-center justify-center backdrop-blur-xs rounded-lg z-10"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 24 24"
                    fill="currentColor"
                    class="animate-spin w-10 text-black dark:text-white"
                >
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M12 2c5.523 0 10 4.477 10 10s-4.477 10 -10 10s-10 -4.477 -10 -10s4.477 -10 10 -10zm6 9a1 1 0 0 0 -1 1a5 5 0 0 1 -5 5a1 1 0 0 0 0 2a7 7 0 0 0 7 -7a1 1 0 0 0 -1 -1z" />
                </svg>

                <p class="text-xs capitalize font-medium text-black dark:text-white">{{ __('please wait...') }}</p>
            </div>

            <div x-show="!image_selected">
                <div class="w-full flex items-center">
                    <!-- Back Button if in a subfolder -->
                    <div class="mb-4 flex items-center gap-4">
                        <button
                            type="button"
                            x-show="current_path && current_path !== '/'"
                            @click="$wire.loadGallery(current_path.split('/').slice(0, -1).join('/'))"
                            class="float-left text-white p-1 rounded bg-black/5 hover:cursor-pointer hover:opacity-80"
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
                                class="stroke-gray-500 icon icon-tabler icons-tabler-outline icon-tabler-arrow-left"
                            >
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M5 12l14 0" />
                                <path d="M5 12l6 6" />
                                <path d="M5 12l6 -6" />
                            </svg>
                        </button>

                        <div class="flex items-center gap-2">
                            <span class="text-xs bg-gray-200 rounded py-1 overflow-hidden">
                                <span class="font-medium bg-gray-300 border-r-gray-300 py-1 px-2">DISK: </span>
                                <span class="px-2">{{ $this->disk }}</span>
                            </span>

                            <span class="font-medium text-sm">{{ $current_path }}</span>
                        </div>
                    </div>

                    <div class="ml-auto flex items-center gap-2">
                        <button
                            type="button"
                            @click="
                                if (confirm('Deleting a folder will delete all content including all sub folders and files. Are you sure?')) {
                                    $wire.deleteDirectory();
                                }
                            "
                            x-show="current_path && current_path !== '/'"
                            class="flex items-center gap-2 text-sm font-medium text-red-500 px-1 rounded border-2 border-red-500 hover:cursor-pointer hover:opacity-80"
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
                                class="icon icon-tabler icons-tabler-outline icon-tabler-folder-off"
                            >
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M8 4h1l3 3h7a2 2 0 0 1 2 2v8m-2 2h-14a2 2 0 0 1 -2 -2v-11a2 2 0 0 1 1.189 -1.829" />
                                <path d="M3 3l18 18" />
                            </svg>
                            Delete Directory
                        </button>

                        <button
                            type="button"
                            @click="open = false"
                            class="text-gray-500 hover:text-gray-700 p-1 rounded-sm bg-black/5 hover:cursor-pointer hover:opacity-80"
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
                                class="icon icon-tabler icons-tabler-outline icon-tabler-x"
                            >
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M18 6l-12 12" />
                                <path d="M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>

                @error('mediafile')
                <div class="text-sm bg-red-200 text-red-800 rounded p-2 my-2">
                    File error: {{ $message }}
                </div>
                @enderror

                <!-- File List: Folders and Images -->
                <div class="mt-4 grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 xl:grid-cols-8 2xl:grid-cols-10 gap-8 max-h-[90vh] overflow-y-auto">
                    <div x-data="{ open: false }" @click.outside="open = false" class="flex justify-center">
                        <button
                            type="button"
                            x-ref="button"
                            @click="open = ! open"
                            class="w-full max-w-30 max-h-30 rounded-md border-3 border-gray-200 flex items-center justify-center align-middle hover:cursor-pointer hover:opacity-80"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="24"
                                height="24"
                                viewBox="0 0 24 24"
                                fill="currentColor"
                                class="fill-gray-400 icon icon-tabler icons-tabler-filled icon-tabler-circle-plus"
                            >
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M4.929 4.929a10 10 0 1 1 14.141 14.141a10 10 0 0 1 -14.14 -14.14zm8.071 4.071a1 1 0 1 0 -2 0v2h-2a1 1 0 1 0 0 2h2v2a1 1 0 1 0 2 0v-2h2a1 1 0 1 0 0 -2h-2v-2z" />
                            </svg>
                        </button>

                        <div
                            x-show="open"
                            x-anchor="$refs.button"
                            class="bg-white shadow-lg border border-gray-200 rounded-sm flex flex-col"
                        >
                            <button
                                type="button"
                                @click="confirmAndCreateFolder(); open = false"
                                class="w-full text-sm px-5 py-1 hover:bg-gray-100 hover:cursor-pointer"
                            >
                                {{ __('Create New Folder') }}
                            </button>

                            <div>
                                <button
                                    type="button"
                                    @click="$refs.fileInput.click(); open = false"
                                    class="capitalize w-full text-sm px-5 py-1 hover:bg-gray-100 hover:cursor-pointer"
                                >
                                    {{ __('upload file') }}
                                </button>

                                <input
                                    type="file"
                                    x-ref="fileInput"
                                    wire:model="mediafile"
                                    class="hidden"
                                    accept="image/*, .doc, .docx, .xls, .xlsx, .pdf, .mp4"
                                />
                            </div>
                        </div>
                    </div>

                    <template x-for="file in files" :key="file.name">
                        <div class="w-full">
                            {{-- FOLDERS --}}
                            <template x-if="file.type === 'folder'" :title="file.name">
                                <button
                                    type="button"
                                    @click="$wire.loadGallery(file.path)"
                                    class="flex flex-col justify-center items-center text-blue-500 hover:underline hover:cursor-pointer hover:opacity-80"
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="72"
                                        height="72"
                                        viewBox="0 0 24 24"
                                        fill="currentColor"
                                        class="fill-amber-400 icon icon-tabler icons-tabler-filled icon-tabler-folder"
                                    >
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M9 3a1 1 0 0 1 .608 .206l.1 .087l2.706 2.707h6.586a3 3 0 0 1 2.995 2.824l.005 .176v8a3 3 0 0 1 -2.824 2.995l-.176 .005h-14a3 3 0 0 1 -2.995 -2.824l-.005 -.176v-11a3 3 0 0 1 2.824 -2.995l.176 -.005h4z" />
                                    </svg>
                                    <span x-text="file.name"></span>
                                </button>
                            </template>

                            {{-- FILES --}}
                            <template x-if="file.type === 'file'">
                                <div x-data="{ visible: false }" :title="file.name">
                                    <div
                                        x-intersect:enter="visible = true"
                                        x-intersect:leave="visible = false"
                                    >
                                        <template x-if="visible">
                                            <button
                                                type="button"
                                                @click="image.insertFile(file.url), open = false"
                                                class="hover:cursor-pointer hover:opacity-80 flex flex-col items-start space-y-1 hover:cursor-pointer hover:opacity-80 w-full"
                                            >
                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 24 24"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    stroke-width="2"
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    class="w-full h-auto rounded hover"
                                                >
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                                                    <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />
                                                </svg>

                                                <span
                                                    class="w-full text-sm overflow-hidden text-ellipsis break-words"
                                                    x-text="file.name"
                                                >
                                                </span>
                                            </button>
                                        </template>
                                    </div>
                                </div>
                            </template>

                            {{-- IMAGES --}}
                            <template x-if="file.type === 'image'">
                                <div x-data="{ visible: false }" :title="file.name">
                                    <div
                                        x-intersect:enter="visible = true"
                                        x-intersect:leave="visible = false"
                                    >
                                        <template x-if="visible">
                                            <button
                                                type="button"
                                                @click="$dispatch('editImage', {url: file.url, path: file.path}); open = false"
                                                class="hover:cursor-pointer hover:opacity-80 flex flex-col items-start space-y-1 hover:cursor-pointer hover:opacity-80 w-full"
                                            >
                                                <img
                                                    :src="file.url"
                                                    class="aspect-1/1 object-cover rounded border border-gray-200 hover"
                                                />
                                                <span
                                                    class="w-full text-sm overflow-hidden text-ellipsis break-words"
                                                    x-text="file.name"
                                                >
                                                </span>
                                            </button>
                                        </template>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </template>
                </div>
            </div>
        </div>
    </div>
</div>
