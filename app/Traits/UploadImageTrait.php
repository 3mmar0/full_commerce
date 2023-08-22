<?php

namespace App\Traits;

trait UploadImageTrait
{
    public function uploadImg($request, $folder, $fileName = 'img')
    {
        $path = null;
        if (!$request->hasFile($fileName)) {
            return null;
        }
        $file = $request->file($fileName);
        $path = $file->store($folder, [
            'disk' => 'public'
        ]);
        return $path;
    }
}
