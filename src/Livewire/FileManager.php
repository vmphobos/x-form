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
    public string $disk = 'public';
    public string $currentPath = '/'; // Current path of the gallery
    public $files = []; // Files in the current folder
    public $selectedImage = null; // Selected image for preview

    public $image;

    public ?string $folderName = null; // Selected image for preview
    public $loading = false; // Loading state

    // Fetch the contents of the current path (gallery or subfolders)
    public function loadGallery(string $path = '/'): void
    {
        $this->loading = true;

        $this->currentPath = $path;

        // Get the directories (folders) in the current directory on the 'gallery' disk
        $folders = Storage::disk($this->disk)->directories($path);
        $this->files = [];

        // Loop through each folder and create relative URL
        foreach ($folders as $folder) {
            $folderName = basename($folder); // Folder name
            $this->files[] = [
                'name' => $folderName, // Folder name
                'type' => 'folder', // Type: folder
                'path' => str("$path/$folderName")->replace('//', '/')->value(), // Relative path for navigation
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
                    'thumbnail' => Storage::disk($this->disk)->url($item) // URL path for images
                ];
            }
        }

        $this->loading = false;
    }

    // Upload the image when the user selects one
    public function updatedImage($file): void
    {
        // Validate the file (optional but recommended)
        $this->validate([
            'image' => 'image|max:10240',  // 10MB max size
        ]);

        // Store the image in the specified disk and path
        $file->store($this->currentPath, $this->disk);

        $this->loadGallery($this->currentPath);
    }

    // Get files and folders from a specific directory
    public function updatedFolderName(): void
    {
        $this->validateOnly('folderName');

        // Combine the path and folder name
        $fullPath = $this->currentPath.'/'.$this->folderName;

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
        if (!$this->currentPath || $this->currentPath === '/') {
            abort(404);
        }

        // Step 1: Recursively delete all files and subdirectories
        $this->deleteRecursively();

        // Step 2: Delete the now-empty directory
        Storage::disk($this->disk)->deleteDirectory($this->currentPath);

        $this->loadGallery();

        session()->flash('message', 'Directory and its contents have been deleted successfully.');
    }

    private function deleteRecursively(?string $path = null): void
    {
        $path ??= $this->currentPath;
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
        $this->selectedImage = $imagePath;
    }

    // Go back to the previous folder
    public function goBack()
    {
        $this->currentPath = dirname($this->currentPath); // Navigate to the parent directory
        $this->loadGallery($this->currentPath); // Reload the parent directory contents
    }

    // Livewire Render Method
    public function render(): View
    {
        return view('vmphobos::livewire.filemanager');
    }

    protected function rules(): array
    {
        return [
            'folderName' => 'required|regex:/^[a-zA-Z0-9-_\/]+$/',
        ];
    }
}
