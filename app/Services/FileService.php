<?php

namespace App\Services;

use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class FileService
{
    /**
     * @param $image
     * @param $path
     * @param null $filePath
     * @param null $driver
     * @return string
     */
    public static function storeBase64($image, $path, $filePath = null, $driver = null): string
    {
        $storage = self::getStorage($driver);
        if (!$filePath) {
            $fileName = time() . uniqid() . '.jpg';
            $filePath = '/' . $path . '/' . $fileName;
        }
        $data = explode(',', $image);
        $img_string = $data[1];
        $storage->put($filePath, base64_decode($img_string), 'public');

        return $filePath;
    }

    /**
     * @param $file
     * @param $path
     * @param null $driver
     * @return string
     */
    public static function storeFile($file, $path, $driver = null): string
    {
        $storage = self::getStorage($driver);
        $fileName = uniqid() . Str::slug($file->getClientOriginalName(), '.');
        $filePath = '/' . strtolower($path) . '/' . $fileName;
        $storage->put($filePath, file_get_contents($file), 'public');

        return $filePath;
    }

    /**
     * @param $content
     * @param $path
     * @param null $driver
     * @return string
     */
    public static function storeFileFromContent($content, $path, $driver = null): string
    {
        $storage = self::getStorage($driver);
        $filePath = '' . $path;
        $storage->put($filePath, $content, 'public');

        return $filePath;
    }


    /**
     * @param $content
     * @param $path
     * @return string
     */
    public static function storeImage($content, $path): string
    {
        $storage = self::getStorage(null);
        $storage->put($path, $content, 'public');

        return $path;
    }

    /**
     * @param $input
     * @param $name
     * @param $path
     * @param $widths
     * @param $storage
     */
    public static function attachmentThumb($input, $path, $name, $widths, $storage): void
    {
        foreach ($widths as $width) {
            self::attachment($input, $path, $name, $width, $storage);
        }
    }

    /**
     * @param $input
     * @param $name
     * @param $path
     * @param $storage
     * @param $width
     */
    public static function attachment($input, $path, $name,  $width, $storage): void
    {
        try {
            $img = Image::make($input)->resize($width, null, function ($constraint) {
                $constraint->aspectRatio();
            })->response(null, 80);
            $filePath = "$path/thumb/$width/" . $name;
            $storage->put($filePath, $img->getContent(), 'public');

        } catch (\Exception $e) {}
    }

    /**
     * @param $driver
     * @return Filesystem
     */
    private static function getStorage($driver): Filesystem
    {
        $driver = $driver ?: config('filesystems.default');

        return Storage::disk($driver);

    }

    /**
     * @param $path
     * @param $driver
     */
    public static function destroyImage($path, $driver): void
    {
        $storage = self::getStorage($driver);
        $storage->delete($path);
    }
}
