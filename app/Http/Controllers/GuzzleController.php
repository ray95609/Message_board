<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;

class GuzzleController extends Controller
{

    public function index(){

        $client = new Client();
        $response = $client->get('https://covid-19.nchc.org.tw/api/covid19?CK=covid-19@nchc.org.tw&querydata=3001&limited=BGD
');
        $deresponse= json_decode( $response->getBody()->getContents(), true);

        $onedate=$deresponse;

        $onede=$onedate;


        return view('guzzle.index',['onede'=>$onede]);
    }
}
