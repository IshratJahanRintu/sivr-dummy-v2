<?php

namespace App\Traits;


use Illuminate\Support\Str;


trait FileUploadTrait
{

    protected function generateUniqueFilename($file)
    {
        $originalName = $file->getClientOriginalName();

        $extension = $file->getClientOriginalExtension();
        $uniqueString = '_' . time() . '_' . Str::random(10);
        $filename = pathinfo($originalName, PATHINFO_FILENAME) . $uniqueString . '.' . $extension;
        return $filename;
    }

    protected function uploadAndStoreFile($file, $fieldName, $folderName, &$data)
    {
        if ($file) {
            $filename = $this->generateUniqueFilename($file);
            $path = $file->storeAs($folderName, $filename, 'public');
            $data[$fieldName] = $path;
        }
    }

}
