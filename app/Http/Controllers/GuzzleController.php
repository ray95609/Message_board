<?php

namespace App\Http\Controllers;

use Illuminate\Support\Carbon;
use GuzzleHttp\Client;

class GuzzleController extends Controller
{

    public function index(){

        $client = new Client();
        $response = $client->get('https://covid-19.nchc.org.tw/api/covid19?CK=covid-19@nchc.org.tw&querydata=4051&limited=TWN
');
        $deresponse= json_decode( $response->getBody()->getContents(), true);

        $onede=end($deresponse);

        $count=count($deresponse);

        $sevende=array_slice($deresponse,$count-8,7);






        //$now=Carbon::now();
        //$puls=carbon::parse($now)->diffInDays('2022-01-01',true);



        return view('guzzle.index',['onede'=>$onede,'sevende'=>$sevende]);
    }
}
