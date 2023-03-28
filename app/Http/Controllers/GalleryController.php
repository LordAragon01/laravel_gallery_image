<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class GalleryController extends Controller
{

    private $urlapiaddress = "https://api.flickr.com/services/rest/";
    private $urlapiaddressimage = "https://www.flickr.com/services/rest/";
   
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
        $api_data = $this->getApiData($url_api, "photos");

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

    public function getImageUrlApi(bool $check_apiurl, int $id_image):string
    {

        $url = new ApiGalleryController();
        $image = new ApiGalleryImageController();

        //Get API Url method
        $apimethod = $url->setApiMethod($check_apiurl, "flickr.photos.getSizes");

        //Get API Key
        $apikey = $url->setApiKey($check_apiurl, config('app.flickr_key'));

       //Get Photo Id
       $photo_id = $image->setPhotoId($check_apiurl, $id_image);

        //Get Format
        $apiformat = $url->setFormat($check_apiurl, "json");

        //Get Callback
        $apicallback = $url->setCallback($check_apiurl, 1);

        //API URL 
        $apiurl = $this->urlapiaddressimage . $apimethod . $apikey . $photo_id . $apiformat . $apicallback;

        return $apiurl;

    }

    public function getApiData(string $apiurl, string $indicate_key):array|bool
    {

        $response = Http::timeout(5)->
                    acceptJson()->
                    get($apiurl);

        $data = $response->successful() ? $response->json($indicate_key) : $response->failed();            

        return $data;

    }

    public function getMaxApiData(array $apidata, int $max_data = 10):array
    {
        //Check Image API URL 
        $check_apiurl_image = $this->getValidateApiUrl($this->urlapiaddressimage);


        $list_of_photos = $apidata['photo'];
        $array_key = array_rand($list_of_photos, $max_data);

        $dynamic_list = [
            "image" => [
                "id" => [],
                "title" => [],
                "image_info" => []
            ]
        ];

        foreach($list_of_photos as $index => $value){

            if(in_array($index, $array_key)){

                //Get Image from Api
                $url_api_image = $this->getImageUrlApi($check_apiurl_image, $value['id']);

                //Get Api Data
                $api_data_image = $this->getApiData($url_api_image, "sizes");

                //dd($api_data_image["size"][5]["source"]);

                array_push($dynamic_list["image"]["id"], $value['id']);
                array_push($dynamic_list["image"]["title"], $value['title']);
                array_push($dynamic_list["image"]["image_info"], $api_data_image["size"][5]["source"]);

            }

        }

        return $dynamic_list;

    }
 
}
