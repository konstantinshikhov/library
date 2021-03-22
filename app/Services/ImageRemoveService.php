<?php


namespace App\Services;


class ImageRemoveService
{
    public static function removeImage($nameImage)
    {
        $filePath = 'images/books/' . $nameImage;
        if (file_exists($filePath)) {
            unlink($filePath);
        }
    }
}
