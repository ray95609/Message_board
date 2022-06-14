<?php

namespace App\Http\Controllers;

use App\Models\Api_Covid_19;
use Illuminate\Support\Carbon;
use GuzzleHttp\Client;
use MongoDB\Driver\Session;

class GuzzleController extends Controller
{

    public function index(){

        $client = new Client();

        //取得API資料
        $response = $client->get('https://covid-19.nchc.org.tw/api/covid19?CK=covid-19@nchc.org.tw&querydata=4051&limited=TWN');
        //解鎖json
        $deresponse= json_decode( $response->getBody()->getContents(), true);
        //取出最後一個array
        $onede=end($deresponse);
        //array的總數
        $count=count($deresponse);
        //取出最後7個array
        $sevende=array_slice($deresponse,$count-8,7);

        $save_DB_date=[
            'date'=>$onede['a04'],
            'curdate_diagnose'=>$onede['a07'],
            'total_diagnose'=>$onede['a05'],
            'local'=>$onede['a02'],
            'country'=>$onede['a03']

        ];
        $today=Carbon::today();

        $select=Api_Covid_19::select('api_covid_19.*')
            ->where([['api_covid_19.date','=',$today]])->get();


        //$now=Carbon::now();
        //$puls=carbon::parse($now)->diffInDays('2022-01-01',true);


        //直接從api讀出,不經過資料庫
       // return view('guzzle.index',['onede'=>$onede,'sevende'=>$sevende]);


        if ($select->isEmpty()){

            $save=Api_Covid_19::create($save_DB_date);
            //把資料丟進Session裡
            session(['API'=>'DB無資料']);
            return view('guzzle.index',['onede'=>$onede,'sevende'=>$sevende]);

        }else{
            //把資料丟進Session裡
           session(['DB'=>'DB有資料']);
            return view('guzzle.index',['select'=>$select,'sevende'=>$sevende]);

        }


    }
}
