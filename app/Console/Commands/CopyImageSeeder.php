<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class CopyImageSeeder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'copy-image-seeder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Copy images from seedersImage to public/storage directory';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting to copy images from seedersImage to public/storage...');

        $sourcePath = public_path('seedersImage');
        $destinationPath = public_path('storage');

        // Check if source directory exists
        if (!File::exists($sourcePath)) {
            $this->error('Source directory seedersImage does not exist!');
            return 1;
        }

        // Create destination directory if it doesn't exist
        if (!File::exists($destinationPath)) {
            File::makeDirectory($destinationPath, 0755, true);
            $this->info('Created storage directory: ' . $destinationPath);
        }

        // Get all directories in seedersImage
        $directories = File::directories($sourcePath);

        if (empty($directories)) {
            $this->info('No subdirectories found in seedersImage');
            return 0;
        }

        $totalFilesCopied = 0;

        foreach ($directories as $directory) {
            $folderName = basename($directory);
            $destinationFolder = $destinationPath . '/' . $folderName;

            // Create destination folder if it doesn't exist
            if (!File::exists($destinationFolder)) {
                File::makeDirectory($destinationFolder, 0755, true);
                $this->info('Created folder: ' . $folderName);
            }

            // Get all files in the source directory
            $files = File::allFiles($directory);

            foreach ($files as $file) {
                $fileName = $file->getFilename();
                $sourceFile = $directory . '/' . $fileName;
                $destinationFile = $destinationFolder . '/' . $fileName;

                // Copy the file
                File::copy($sourceFile, $destinationFile);
                $totalFilesCopied++;

                $this->line('Copied: ' . $folderName . '/' . $fileName);
            }
        }

        $this->info('Successfully copied ' . $totalFilesCopied . ' images to public/storage');

        return 0;
    }
}
