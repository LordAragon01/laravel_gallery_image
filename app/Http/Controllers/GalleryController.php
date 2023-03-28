<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GalleryController extends Controller
{

    private $urlapiaddress = "https://api.flickr.com/services/rest/";
   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ApiGalleryController $url)
    {

        //Page Title
        $title = "Galeria de Imagens";

        //Check API URL
        $check_apiurl = $this->getValidateApiUrl($this->urlapiaddress);

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

        //API URL 
        $apiurl = $this->urlapiaddress . $apimethod . $apikey . $apitags . $apipage . $apiformat . $apicallback;

        var_dump($apiurl);

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
