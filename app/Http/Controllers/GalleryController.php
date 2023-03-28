<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class GalleryController extends Controller
{

    private $urlapiaddress = "https://api.flickr.com/services/rest/";
   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        //Page Title
        $title = "Galeria de Imagens";

        //Check API URL
        $check_apiurl = $this->getValidateApiUrl($this->urlapiaddress);

        //Url Api
        $url_api = $this->getUrlApi($check_apiurl);

        //Get Api Data
        $api_data = $this->getApiData($url_api);

        //Get Max inform from Data
        $limit_data = $this->getMaxApiData($api_data);

        dd($limit_data);

        return view("pages.home", compact(
            'title',
            'check_apiurl'
        ));

    }


    public function getValidateApiUrl(string $urlapi):bool
    {

        $url = new ApiGalleryController();

        //URL API construct
        $url->setUrlApi($urlapi);
        $url_api = $url->getUrlApi();

        //URL API validate
        $checkurl = $url->checkUrl($url_api);
        $checkhttps = $url->httpsVerify($url_api);

        $validate_url = $checkurl && $checkhttps === true ? true : false;

        return $validate_url;

    }

    public function getUrlApi(bool $check_apiurl):string
    {

        $url = new ApiGalleryController();

        //Get API Url method
        $apimethod = $url->setApiMethod($check_apiurl, "flickr.photos.search");

        //Get API Key
        $apikey = $url->setApiKey($check_apiurl, config('app.flickr_key'));

        //Get Tags
        $apitags = $url->setTags($check_apiurl, "kitten");

        //Get Page
        $apipage = $url->setPage($check_apiurl, 1);

        //Get Format
        $apiformat = $url->setFormat($check_apiurl, "json");

        //Get Callback
        $apicallback = $url->setCallback($check_apiurl, 1);

        //Get Privacy Filter
        $privacyfilter = $url->setPrivacyFilter($check_apiurl, 1);
        $apiprivacyfilter = $privacyfilter !== null ? $privacyfilter : "";

        //API URL 
        $apiurl = $this->urlapiaddress . $apimethod . $apikey . $apitags . $apipage . $apiformat . $apicallback . $apiprivacyfilter;

        return $apiurl;

    }

    public function getApiData(string $apiurl):array|bool
    {

        $response = Http::timeout(5)->
                    acceptJson()->
                    get($apiurl);

        $data = $response->successful() ? $response->json("photos") : $response->failed();            

        return $data;

    }

    public function getMaxApiData(array $apidata):array
    {

        $list_of_photos = $apidata['photo'];
        $array_key = array_rand($list_of_photos, 10);

        $dynamic_list = [];

        foreach($list_of_photos as $index => $value){

            if(in_array($index, $array_key)){

                array_push($dynamic_list, $value);

            }

        }

        return $dynamic_list;

    }
 
}
