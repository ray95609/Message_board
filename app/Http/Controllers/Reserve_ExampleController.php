<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Reserve;
use Illuminate\Support\Facades\DB;

class Reserve_ExampleController extends Controller
{


    /**
     * @Notes function 日後可以再call 其實最好可以做一個 function 檔案以後可以用
     * @User rogerlu
     * @Date 2022/6/28
     * @Time 下午 05:58
     * @param $passWeek
     * @param $limitDay
     * @return array
     */
    public function getDaysMethod($passWeek, $limitDay)
    {

        $sevenDay = [];
        $beginCount = 2;
        $currentDateTime = Carbon::now();
        do {
            $preDate = $currentDateTime->addDay();
            if (!in_array($preDate->dayOfWeek, $passWeek)) {
                //直接format 前端就不用再轉了
                $sevenDay[] = $preDate->format('Y-m-d');
                $beginCount++;
            } else {
                $beginCount--;
            }
            $currentDateTime = $preDate;
        } while ($beginCount < $limitDay);

        return $sevenDay;
    }

    /**
     * @Notes 取得 hr 時段 其實最好可以做一個 function 檔案以後可以用
     * @User rogerlu
     * @Date 2022/6/28
     * @Time 下午 06:04
     * @param $beginHr
     * @param $limitTime
     * @return array
     */
    public function getHrMethod($beginHr, $limitTime)
    {
        //產出7個時段的集合
        $time = Carbon::createFromTime($beginHr)->format('H:i');
        $workTime = [];
        for ($i = 0; $i < $limitTime; $i++) {
            $workTime[] = $time;
            //直接format 前端就不用再轉了
            $time = Carbon::parse($time)->addHour()->format('H:i');
        }
        return $workTime;
    }

    public function index()
    {
        //幾日
        $limitDay = 7;
        //時段
        $limitTime = 7;
        //起始時段
        $beginHr = 11;
        //跳過星期 6 日
        $passWeek = [6, 0];
        $sevenDay = $this->getDaysMethod($passWeek, $limitDay);
        $workTime = $this->getHrMethod($beginHr, $limitTime);

        /**
         *  SQL => GROUP BY DATE TIME 找出超過三次
         *
         *  SELECT CONCAT(DATE," ",TIME) AS overThreeTimesDate,COUNT(*) FROM reserve
         *  WHERE STATUS=0
         * GROUP BY DATE,TIME HAVING COUNT(*)>=3
         */
        $ReserveOver3Days = Reserve::where(["status" => 0])
            ->select([
                DB::RAW('CONCAT(DATE,DATE_FORMAT(TIME,"%H:%i")) AS overThreeTimesDate')
            ])
            ->groupBy(['DATE', 'TIME'])
            ->having(DB::raw('count(*)'), '>=', 3)
            ->get();

        //之前跟你說的 方法 可以直接取得陣列
        $checkDateTime = $ReserveOver3Days->pluck('overThreeTimesDate')->toArray();

        return view('Reserve.index_example', [
            'sevenday' => $sevenDay,
            'workTime' => $workTime,
            'checkDateTime' => $checkDateTime
        ]);
    }


    public function create(Request $request)
    {
        //沒登入 就導走 不用再下 else
        if (!Auth::id()) {
            return redirect()->route('login');
        }

        $reserveData = [
            'date' => $request['date'],
            'time' => $request['time'],
            'designer' => $request['designer'],
            'status' => 0,
            'user_id' => Auth::id(),
            'update_id' => Auth::id()
        ];

        //TODO where 太複雜可以這樣寫
        $where = [];
        $where[] = ['date', '=', $request['date']];
        $where[] = ['time', '=', $request['time']];
        $where[] = ['designer', '=', $request['designer']];
        $where[] = ['status', '=', 0];

        //TODO 如果資料重複，就存不進去
        $checkReserve = Reserve::select(['reserve.*'])->where($where)->get();

        if ($checkReserve->isNotEmpty()) {
            return redirect()->route('reserve_example.index')
                ->with('fail', '預約失敗,請選擇其他時間');
        } else {
            $reserve = Reserve::create($reserveData);
            if ($reserve) {
                return redirect()->route('reserve_example.index')
                    ->with('success', '預約成功');
            } else {
                return redirect()->route('reserve_example.index')
                    ->with('fail', '預約失敗,請選擇其他時間');
            }
        }

    }


    public function history($user_id)
    {

        //沒登入 就導走 不用再下 else
        if (!Auth::id()) {
            return redirect()->route('login');
        }

        $history = Reserve::join('users', 'reserve.user_id', '=', 'users.id')
            ->select('reserve.*', 'users.*')
            ->where('reserve.user_id', '=', $user_id)
            ->orderBy('date')->paginate(5);

        if ($history) {
            return view('Reserve.history', ['history' => $history]);
        } else {
            return redirect()->route('reserve_example.index')->with('nohistory', '沒有預約紀錄');
        }
    }

    /***
     * TODO
     * 取消預約
     */
}
