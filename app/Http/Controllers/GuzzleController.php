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

        $onede=$deresponse;

        $now=Carbon::now();

        $puls=carbon::parse($now)->diffInDays('2022-01-01',true);

        if($onede[$puls]){
            $puls=$puls;

        }else{
            $puls=$puls-1;

        };


        return view('guzzle.index',['onede'=>$onede , 'puls'=>$puls]);
    }
}
