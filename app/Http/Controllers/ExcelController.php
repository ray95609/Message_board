<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Exports\historyReserveExport;
use App\Exports\csvHistoryReserveExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Reserve;
use App\Exports\ReserveExport;


class ExcelController extends Controller
{
    public function allReserveExport(){

        //匯出所有Reserve的資料
        $time=Carbon::now();
        return Excel::download(new ReserveExport, $time.'reserveList.xlsx');

    }


    public function userIdReserveExport($user_id){

        $time=Carbon::now();
          return (new historyReserveExport($user_id))->download($time.'userReserveList.xlsx');

    }

    public function csvUserIdReserveExport($user_id){

        $time=Carbon::now();
        return (new csvHistoryReserveExport($user_id))->download($time.'userReserveList.csv');

    }

}
