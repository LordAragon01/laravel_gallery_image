<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GalleryController extends Controller
{

    private $urlapiaddress = "https://api.flickr.com/services/rest/";
    //private $apikey = env("FLICKR_API_KEY");
   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ApiGalleryController $url)
    {

        $check_apiurl = $this->getValidateApiUrl($this->urlapiaddress);

        //Check API URL
        if($check_apiurl){

            //Get API Url method
            $apimethod = $url->setApiMethod($check_apiurl, "?method=flickr.photos.search");

            //Get API Key
            $key = $url->setApiKey($check_apiurl, config('app.flickr_key'));

            //API URL 
            $apiurl = $this->urlapiaddress . $apimethod . '&' . $key;

            var_dump($apiurl);

        }

        $title = "Galeria de Imagens";

        return view("pages.home", compact(
            'title'
        ));

    }

    public function apiKey(){

        return env('APP_NAME');

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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
