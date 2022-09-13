<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;

trait ImageFunctions
{
    //delete image if exist in storage
    public function delete_if_exist($image) {
        $existInStorage = Storage::exists($image);
        $existInStorage ? Storage::Delete($image) : '';
    }

    //return image path in storage after create it
    public function store_image_path($image,$folder_name) {
        $filename = time().'.'.$image->getClientOriginalExtension();
        $path = $image->storeAs($folder_name, $filename);

        return $path;
    }

    //return image path in storage after create it
    public function store_unique_image_path($name,$image,$folder_name) {
        $filename = $name.'.'.$image->getClientOriginalExtension();
        $path = $image->storeAs($folder_name, $filename);

        return $path;
    }

}
