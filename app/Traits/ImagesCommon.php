<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;

trait ImagesCommon {
    public function saveImage(&$piece, $image, $path){
        $destinationPath = storage_path($path);
        $defaultPhotoPath = 'assets/images/noimage.jpg';

        if ($image) {
            $photoName = time() . '.' . $image->getClientOriginalExtension();
            $image->move($destinationPath, $photoName);
            $piece->photo = 'photos/pieces/'.$photoName;
        } else {
            $piece->photo = $defaultPhotoPath;
        }
    }



}
