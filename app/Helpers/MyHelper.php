<?php

use Intervention\Image\Laravel\Facades\Image;
use Illuminate\Support\Facades\Storage;

if (!function_exists('StoreFile')) {
    function StoreFile($file,$dir,$oldfile=null,$qty=50){

        if(!empty($oldfile)){
            if(!empty($file)){
                if(Storage::disk('public')->exists($oldfile)){
                    Storage::disk('public')->delete($oldfile);
                }
                $path=$file->store($dir,'public');
                $compress=Image::read(Storage::disk('public')->path($path))->toJpeg($qty)->save(Storage::disk('public')->path($path));
            }else{
                $path=$oldfile;
            }  
        }else{
            if(!empty($file)){
                $path=$file->store($dir,'public');
                $compress=Image::read(Storage::disk('public')->path($path))->toJpeg($qty)->save(Storage::disk('public')->path($path));
            }else{
                $path=null;
            }
            
        }

        return $path;
    }
}

if (!function_exists('showimg')) {
    function showimg($imgpath, $avatar=false) { 

        if(!empty($imgpath)){
            if(Storage::disk('public')->exists($imgpath)){
                $val=asset('storage/'.$imgpath);
            }else{
                if($avatar){
                    $val=asset('img/avatar.png');
                }else{
                    $val=asset('img/image.png');
                }
            } 
        }else{
            if($avatar){
                $val=asset('img/avatar.png');
            }else{
                $val=asset('img/image.png');
            }
        }

        return $val;
    }
}