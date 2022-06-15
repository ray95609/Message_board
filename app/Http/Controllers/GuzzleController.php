<?php

namespace App\Http\Controllers;

use App\Models\Api_Covid_19;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Request;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Support\Carbon;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class GuzzleController extends Controller
{

    protected string $apiUrl = 'https://covid-19.nchc.org.tw/api/covid19?CK=covid-19@nchc.org.tw&querydata=4051&limited=TWN';


    public function index()
    {

        $client = new Client();

        //取得API資料
        $response = $client->get('https://covid-19.nchc.org.tw/api/covid19?CK=covid-19@nchc.org.tw&querydata=4051&limited=TWN');
        //解鎖json
        $deresponse = json_decode($response->getBody()->getContents(), true);
        //取出最後一個array
        $onede = end($deresponse);
        //array的總數
        $count = count($deresponse);
        //取出最後7個array
        $sevende = array_slice($deresponse, $count - 8, 7);

        $save_DB_date = [
            'date' => $onede['a04'],
            'curdate_diagnose' => $onede['a07'],
            'total_diagnose' => $onede['a05'],
            'local' => $onede['a02'],
            'country' => $onede['a03']
        ];
        $today = Carbon::now();
        $today_19PM = Carbon::today()->addHours(19);
        $yesterday = Carbon::yesterday();

        //這邊怪怪的 今日永遠不會大於 +19 小時的 今日時間
        if ($today > $today_19PM) {
            $today = $today;
        } else {
            $today = $yesterday;
        }

        $select = Api_Covid_19::select('api_covid_19.*')
            ->where([['api_covid_19.date', '=', $today]])->get();


        //$now=Carbon::now();
        //$puls=carbon::parse($now)->diffInDays('2022-01-01',true);


        //直接從api讀出,不經過資料庫
        // return view('guzzle.index',['onede'=>$onede,'sevende'=>$sevende]);


        if ($select->isEmpty()) {

            $save = Api_Covid_19::create($save_DB_date);
            //把資料丟進Session裡
            Session::forget('DB');
            session(['API' => 'DB無資料']);
            return view('guzzle.index', ['onede' => $onede, 'sevende' => $sevende]);

        } else {
            //把資料丟進Session裡
            Session::forget('API');
            session(['DB' => 'DB有資料']);
            return view('guzzle.index', ['select' => $select, 'sevende' => $sevende]);

        }


    }


    /**
     * @Notes call 確診 API 呈現範例
     * @User rogerlu
     * @Date 2022/6/15
     * @Time 下午 02:54
     * @return Application|Factory|View
     * @throws GuzzleException
     */
    public function example_index()
    {

        //拿到API 最後一筆 為昨日資料，看起來那個 API 只提供到昨日
        $yestoday = Carbon::yesterday()->format('Y-m-d');
        $yestodayData = Api_Covid_19::where(['date' => $yestoday])->get()->first();
        //組成session key
        $todayCov7DayDataKey = "Cov7DayData".Carbon::yesterday()->format('Ymd');

        //沒有昨日資料 或 沒有今日七天資料 call api
        if (!$yestodayData || !Session::has($todayCov7DayDataKey)) {
            Session::forget($todayCov7DayDataKey);
            $apiData = $this->getCov19ApiData($this->apiUrl);
            //取出最後一個array
            $todayApiData = end($apiData);
            //array的總數
            $count = count($apiData);
            //取出最後7個array
            $last7Data = array_slice($apiData, $count - 8, 7);

            //放入今日7天資訊 進入session
            Session::put($todayCov7DayDataKey,json_encode($last7Data));
            //新增
            $created = Api_Covid_19::create([
                'date' => $todayApiData['a04'],
                'curdate_diagnose' => $todayApiData['a07'],
                'total_diagnose' => $todayApiData['a05'],
                'local' => $todayApiData['a02'],
                'country' => $todayApiData['a03']
            ]);
            //再找出剛剛新增 data row
            $yestodayData = Api_Covid_19::find($created->id);
        }else{
            //有資料就不用call api 不然會一直 call API 會發現頁面讀取很久
            $last7Data = Session::get($todayCov7DayDataKey);
            $last7Data = json_decode($last7Data,true);
        }
        return view('guzzle.example_index', ['yestodayData' => $yestodayData, 'last7Data' => $last7Data]);
    }

    /**
     * @Notes 取得cov19 API資訊method
     * @User rogerlu
     * @Date 2022/6/15
     * @Time 下午 01:44
     * @param $url
     * @return array
     * @throws GuzzleException
     */
    protected function getCov19ApiData($url)
    {
        $client = new Client();
        //取得API資料
        $response = $client->get($url);
        //解鎖json
        return json_decode($response->getBody()->getContents(), true);
    }

}
