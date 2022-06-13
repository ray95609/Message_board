

@extends('layouts.app')

@section('content')


    <!--用日期的套件算出差距日-->


    <h5>COVID-19 確診數據</h5>
    <p>日期:{{$onede[$puls]['a04']}}</p>
    <p>國家:{{$onede[$puls]['a03']}}</p>
    <p>地區:{{$onede[$puls]['a02']}}</p>
    <p>總確診:{{$onede[$puls]['a05']}}</p>
    <p>新增確診:{{$onede[$puls]['a07']}}</p>


    <!--接下來要存入資料庫  再讀出來  稍微研究一下boostrap-->




@endsection
