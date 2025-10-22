<?php

namespace Vmphobos\XForm\Livewire;

use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Livewire\Attributes\Locked;
use Livewire\Component;
use Livewire\WithFileUploads;

class FileManager extends Component
{
    use WithFileUploads;

    #[Locked]
    public string $disk;

    public string $current_path = '/'; // Current path of the gallery
    public $files = []; // Files in the current folder
    public $selected_image = null; // Selected image for preview

    public $mediafile;

    public ?string $folder_name = null; // Selected image for preview

    public function mount(): void
    {
        $this->disk = config('x-form.disk');
    }

    // Fetch the contents of the current path (gallery or subfolders)
    public function loadGallery(string $path = '/'): void
    {
        $this->current_path = $path;

        // Get the directories (folders) in the current directory on the 'gallery' disk
        $folders = Storage::disk($this->disk)->directories($path);
        $this->files = [];

        // Loop through each folder and create relative URL
        foreach ($folders as $folder) {
            $folder_name = basename($folder); // Folder name
            $this->files[] = [
                'name' => $folder_name, // Folder name
                'type' => 'folder', // Type: folder
                'path' => str("$path/$folder_name")->replace('//', '/')->value(), // Relative path for navigation
                'url' => Storage::disk($this->disk)->url("$folder") // URL path for folder (accessible via Storage::url)
            ];
        }

        // Get only files in the current directory (no subfolders)
        $items = Storage::disk($this->disk)->files($path);

        foreach ($items as $item) {
            // Check if it's an image file (jpg, jpeg, png, gif)
            if (in_array(strtolower(pathinfo($item, PATHINFO_EXTENSION)), ['jpg', 'jpeg', 'png', 'gif'])) {
                $this->files[] = [
                    'name' => basename($item),
                    'type' => 'image',
                    'path' => str("$path/".basename($item))->replace('//', '/')->value(), // Relative path for images
                    'url' => Storage::disk($this->disk)->url($item) // URL path for images
                ];
            }
            else {
                $this->files[] = [
                    'name' => basename($item),
                    'type' => 'file',
                    'path' => str("$path/".basename($item))->replace('//', '/')->value(), // Relative path for images
                    'url' => Storage::disk($this->disk)->url($item) // URL path for images
                ];
            }
        }
    }

    // Upload the image when the user selects one
    public function updatedMediafile($file): void
    {
        // Validate the file
        $this->validate([
            'mediafile' => 'file|mimes:' . config('x-form.mime_types'),
        ]);

        $real_filename = $file->getClientOriginalName();

        // Check if file already exists in the directory
        $filePath = $this->current_path . '/' . $real_filename;

        // If the file already exists, append a unique ID to the filename
        if (Storage::disk($this->disk)->exists($filePath)) {
            // Append uniqid() to the filename to make it unique
            $filenameWithoutExtension = pathinfo($real_filename, PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();

            // Generate a new filename with uniqid()
            $real_filename = $filenameWithoutExtension . '-' . uniqid() . '.' . $extension;
        }

        // Store the file with the updated (or original) filename
        $file->storeAs($this->current_path, $real_filename, $this->disk);


        $this->loadGallery($this->current_path);
    }

    // Get files and folders from a specific directory
    public function updatedFolderName(): void
    {
        $this->validateOnly('folder_name');

        // Combine the path and folder name

        $fullPath = str($this->current_path.'/'.$this->folder_name)->replace('//', '/')->value();

        // Create the folder
        if (Storage::disk($this->disk)->makeDirectory($fullPath)) {
            $this->loadGallery($fullPath);

            session()->flash('message', 'Folder created successfully.');
        }
        else {
            session()->flash('error', 'Failed to create the folder.');
        }
    }

    public function deleteDirectory(): void
    {
        if (!$this->current_path || $this->current_path === '/') {
            abort(404);
        }

        // Step 1: Recursively delete all files and subdirectories
        $this->deleteRecursively();

        // Step 2: Delete the now-empty directory
        Storage::disk($this->disk)->deleteDirectory($this->current_path);

        $this->loadGallery();

        session()->flash('message', 'Directory and its contents have been deleted successfully.');
    }

    private function deleteRecursively(?string $path = null): void
    {
        $path ??= $this->current_path;
        // Get all files in the directory
        $files = Storage::disk($this->disk)->files($path);
        foreach ($files as $file) {
            // Delete each file
            $this->deleteFile($file);
        }

        // Get all subdirectories
        $directories = Storage::disk($this->disk)->directories($path);
        foreach ($directories as $directory) {
            // Recursively delete each subdirectory and its contents
            $this->deleteRecursively(path: $directory);
        }
    }

    public function deleteFile($file): void
    {
        Storage::disk($this->disk)->delete($file);
    }

    // Select an image and preview it
    public function selectImage($imagePath): void
    {
        $this->selected_image = $imagePath;
    }

    // Go back to the previous folder
    public function goBack(): void
    {
        $this->current_path = dirname($this->current_path); // Navigate to the parent directory
        $this->loadGallery($this->current_path); // Reload the parent directory contents
    }

    // Livewire Render Method
    public function render(): View
    {
        return view('x-form::livewire.filemanager');
    }

    protected function rules(): array
    {
        return [
            'folder_name' => 'required|regex:/^[a-zA-Z0-9-_\/]+$/',
        ];
    }
}
