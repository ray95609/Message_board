<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReserveController extends Controller
{
    public function index(){

        //產出未來7天的集合

        //產出7個時段的集合

        //找出資料庫已存在預約存入集合中



        return view('Reserve.index');
    }

    /***
     * TODO
     * 預約寫入資料庫 function
     */
}
