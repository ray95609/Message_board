<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Reserve;

class ReserveController extends Controller
{
    public function index(){

        //產出未來7天的集合
        //把日期格式String化，不然等等迴圈會一直操作同一塊記憶體
        $oneday=Carbon::tomorrow()->toDateString();

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

        //找出資料庫已存在預約存入集合中 用來比對是否已預約額滿
        //把已經預約的資料找出來(status=0)
        $reserve=Reserve::select(['reserve.*'])
            ->where([['status','=','0']])->get();
        $countReveser=count($reserve);

        //製作已預約日期與時間集合
        $checkDatas=array();

        for ($i=0;$i<=$countReveser-1;$i++){
            //把時間跟日期挑出來，塞進檢查集合
            $checkData=$reserve[$i]->date;
            $checkTime=$reserve[$i]->time;
            $checkDatas[]=$checkData.' '.$checkTime;

        }

        //找出重複次數大於3的值
       $repeat=array_count_values($checkDatas);
       $countRepeat=count($repeat);


       //array_filter的過濾方法
      $repeatList=array_filter($repeat,function ($v){
           return $v==3;
       });

      //取出key
      $repeatList=array_keys($repeatList);
      $countRepeatList=count($repeatList);

      //把完整間切成日期跟時間 再塞到集合裡

      for ($k=0;$k<$countRepeatList;$k++){
          $repeatDate=Carbon::parse($repeatList[$k])->format('Y-m-d');
          $repeatDateList[]=$repeatDate;

          $repeatTime=Carbon::parse($repeatList[$k])->format('H:i');
          $repeatTimeList[]=$repeatTime;

      }

      /*終於找出額滿的日期跟時段，現在要丟到前端去做比較*/






        return view('Reserve.index',['sevenday'=>$sevenDay,'workTime'=>$workTime,
                                          'repeatDateList'=>$repeatDateList,'repeatTimeList'=>$repeatTimeList]);
    }


    public function create(Request $request){

        if(!Auth::id()){


            return redirect()->route('login');
        }else {

            $all = $request->all();


            $reserveData = [
                'date' => $request['date'],
                'time' => $request['time'],
                'designer' => $request['designer'],
                'status' => 0,
                'user_id' => Auth::id(),
                'update_id' => Auth::id()

            ];

            //TODO 如果資料重複，就存不進去
            $checkReserve=Reserve::select(['reserve.*'])
                ->where([['date','=',$request['date']],
                         ['time','=',$request['time']],
                         ['designer','=',$request['designer']],
                         ['status','=',0]
                         ])->get();



            if($checkReserve->count()>0){

                return redirect()->route('reserve.index')
                    ->with('fail', '預約失敗,請選擇其他時間');

            }else {

                $reserve = Reserve::create($reserveData);

                if ($reserve) {
                    return redirect()->route('reserve.index')
                        ->with('success', '預約成功');
                } else {
                    return redirect()->route('reserve.index')
                        ->with('fail', '預約失敗,請選擇其他時間');
                }
            }
        }
    }


    /***
     * TODO
     * 查看預約紀錄、取消預約
     */
}