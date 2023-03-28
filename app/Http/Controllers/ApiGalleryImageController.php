<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiGalleryImageController extends ApiGalleryController
{
    
    public function setPhotoId(bool $checkurlapi, int $photo_id):string|null
    {

        return $checkurlapi === true ? "&photo_id=". strval($photo_id) : null;

    }


}
