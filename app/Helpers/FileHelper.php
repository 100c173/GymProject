<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;

class FileHelper
{
    /**
     *  Upload and save an image , Upload and save PDF file
     *
     * @param \Illuminate\Http\UploadedFile $file
     * @param string $path
     * @return string|null
     */
    public static function uploadFile($file, $path = 'uploads')
    {
        if ($file && $file->isValid()) {
            $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->storeAs($path, $fileName, 'public');
            return $path . '/' . $fileName;
        }

        return null;
    }
}
