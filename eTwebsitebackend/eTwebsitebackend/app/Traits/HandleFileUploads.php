<?php

namespace App\Traits;

use Illuminate\Http\Request;

trait HandleFileUploads
{
    /**
     * Handle file upload and return the storage path
     */
    protected function uploadFile(Request $request, $fieldName, $directory)
    {
        if ($request->hasFile($fieldName)) {
            return '/storage/' . $request->file($fieldName)->store($directory, 'public');
        }
        return null;
    }

    /**
     * Handle multiple file uploads
     */
    protected function uploadFiles(Request $request, $fields, $directory)
    {
        $data = [];
        foreach ($fields as $field) {
            if ($request->hasFile($field)) {
                $data[$field] = '/storage/' . $request->file($field)->store($directory, 'public');
            }
        }
        return $data;
    }
}
