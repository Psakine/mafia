<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\File\UploadedFile;

trait FileTrait
{
    /**
     * @param UploadedFile $file
     * @return string
     */
    public function saveFile(UploadedFile $file): string
    {
        return '/storage/'.Storage::disk('public')->putFile('photo', $file);
    }

    /**
     * @param string $filePath
     * @return bool
     */
    public function deleteFile(string $filePath): bool
    {
        return Storage::disk('public')->delete(Str::remove('/storage',$filePath));
    }
}