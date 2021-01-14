<?php

namespace App\Utils;

class AppAsset
{
    const VIDEO = "VIDEO_PATH";
    const IMAGE = "IMAGE_PATH";
    const PDF = "PDF_PATH";

    static function url($type, $path)
    {
        return asset(env($type) . "/" . $path);
    }

    static function storage($type, $path)
    {
        $fixedSystemDirectory = str_replace(['/', '\\'], DIRECTORY_SEPARATOR, env($type) . "/" . $path);

        return public_path($fixedSystemDirectory);
    }
}
