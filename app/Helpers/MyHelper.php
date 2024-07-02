<?php

use Intervention\Image\Laravel\Facades\Image;
use Illuminate\Support\Facades\Storage;

if (!function_exists('StoreFile')) {
    function StoreFile($file,$dir,$qty=50){
        $path=$file->store($dir,'public');
        $img=Image::read(Storage::disk('public')->path($path))->toJpeg($qty)->save(Storage::disk('public')->path($path));
    }
}