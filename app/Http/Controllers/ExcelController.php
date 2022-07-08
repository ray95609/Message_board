<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Exports\historyReserveExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Reserve;


class ExcelController extends Controller
{
    public function allReserveExport(){


        //匯出所有Reserve的資料
        $time=Carbon::now();
        return Excel::download(new ReserveExport, $time.'reserveList.xlsx');


    }

    public function userReserveExport($user_id){

        $time=Carbon::now();
        return Excel::download(new historyReserveExport($user_id), $time.'userReserveList.xlsx');

    }



}
