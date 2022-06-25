<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

class ReserveController extends Controller
{
    public function index(){

        //產出未來7天的集合
        //把日期格式String化，不然等等迴圈會一直操作同一塊記憶體
        $oneday=Carbon::today()->toDateString();

        $sevenDay=array();

        for ($i=0;$i<7;$i++){
            //轉成日期格式再塞進迴圈
            $sevenDay[]=Carbon::parse($oneday);
            //把String日期轉成日期格式，再轉成String 這樣記憶體才會分開
            $oneday=Carbon::parse($oneday)->addDay()->toDateString();

        }

        //產出7個時段的集合
        $time=Carbon::createFromTime(11)->toTimeString();

        $workTime=array();

        for ($i=0;$i<7;$i++){
            $workTime[]=Carbon::parse($time);

            $time=Carbon::parse($time)->addHour()->toTimeString();

        }

        //找出資料庫已存在預約存入集合中



        return view('Reserve.index',['sevenday'=>$sevenDay,'workTime'=>$workTime]);
    }

    /***
     * TODO
     * 預約寫入資料庫 function
     */
}
