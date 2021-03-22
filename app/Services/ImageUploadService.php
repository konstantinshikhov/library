<?php


namespace App\Services;


class ImageUploadService
{

    public static function upload($image)
    {
        $image_name = rand() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images/books'), $image_name);
        return $image_name;
    }
}
