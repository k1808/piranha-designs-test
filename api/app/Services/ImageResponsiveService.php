<?php

namespace App\Services;

use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ImageResponsiveService
{
    public function getDisk(): Filesystem
    {
        return Storage::disk('public');
    }

    /**
     * @param UploadedFile $file
     * @param string $type
     * @param array $sizes
     * @param object $model
     * @return string
     */
    public function createResponsiveImages(UploadedFile $file, string $type, array $sizes, object $model): string
    {
        $filename = uniqid(time(), true) . '.' . $file->getClientOriginalExtension();
        foreach($sizes as $key => $value) {
            $this->savePicture($file, $filename, $type, $value, $key, $model);
        }

        return $filename;
    }

    /**
     * @param UploadedFile $file
     * @param string $filename
     * @param string $type
     * @param int $size
     * @param string $platform
     * @param object $model
     * @return string
     */
    public function savePicture(UploadedFile $file, string $filename , string $type, int $size, string $platform, object $model): string
    {

        $image = Image::make($file)->resize($size,null, function ($constraint) {
            $constraint->aspectRatio();
        })->stream();

        if (!$this->getDisk()->exists($type)) {
            $this->getDisk()->makeDirectory($type);
        }
        if (!$this->getDisk()->exists($type.'/'.$model->id.'/'.$platform)) {
            $this->getDisk()->makeDirectory($type.'/'.$model->id.'/'.$platform);
        }
        $this->getDisk()->put($type.'/'.$model->id.'/'.$platform . '/' . $filename, $image);

        return $filename;
    }

    /**
     * @param string $filename
     * @param string $type
     * @return void
     */
    public function deleteImage(string $filename, string $type): void
    {
       $directories = $this->getDisk()->allDirectories($type);
       foreach ($directories as $directory) {
           if ($this->getDisk()->exists($directory.'/'.$filename)) {
               $this->getDisk()->delete($directory.'/'.$filename);
           }
       }
    }

    /**
     * @param string $type
     * @return void
     */
    public function deleteAllImage(string $type): void
    {
        $this->getDisk()->delete($type);
    }


    /**
     * @param string $type
     * @return array
     */
    public function getLinks(string $type): array
    {
        $links = [];

        $files = $this->getDisk()->files($type,true);
        foreach ($files as $file) {
            $arrFile = explode('/',$file);
            $links[$arrFile[count($arrFile) - 2]][] = $this->getDisk()->url($file);
        }

        return $links;
    }
}
