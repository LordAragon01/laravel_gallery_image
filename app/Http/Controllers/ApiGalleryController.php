<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiGalleryController
{
    
    protected $url;

    public function __construct(){

        $this->url = $this->getUrlApi();

    }

    public function getUrlApi():?string
    {

        return $this->url;

    }

    public function setUrlApi(string $urlapi){

        $this->url = $urlapi;

    }

    public function checkUrl(string $urlapi):bool
    {

        if(filter_var($urlapi, FILTER_VALIDATE_URL)){

            return true;

        }else{

            return false;

        }

    }

    public function httpsVerify(string $urlapi):bool
    {

        return parse_url($urlapi, PHP_URL_SCHEME) === 'https' ? true : false;

    }

    public function setApiMethod(bool $checkurlapi, string $method):string
    {

        return $checkurlapi === true ? "?method=". $method : "";

    }

    public function setApiKey(bool $checkurlapi, string $apikey):string
    {

        return $checkurlapi === true ? "&api_key=". $apikey : "";

    }

    public function setTags(bool $checkurlapi, string $tags):string
    {

        return $checkurlapi === true ? "&tags=". $tags : "";

    }

    public function setPage(bool $checkurlapi, int $page):string
    {

        return $checkurlapi === true ? "&page=". strval($page) : "";

    }

    public function setFormat(bool $checkurlapi, string $format):string
    {

        return $checkurlapi === true ? "&format=". $format : "";

    }

    public function setCallback(bool $checkurlapi, int $callback):string
    {

        return $checkurlapi === true ? "&nojsoncallback=". strval($callback) : "";

    }

}
