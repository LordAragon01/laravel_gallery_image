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

        return $checkurlapi === true ? $method : "";

    }

    public function setApiKey(bool $checkurlapi, ?string $apikey):string
    {

        return $checkurlapi === true ? "api_key=". $apikey : "";

    }

}
