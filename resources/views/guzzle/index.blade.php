

@extends('layouts.app')

@section('content')


    <!--接下來要存入資料庫  再讀出來  稍微研究一下boostrap-->
    <!--迴圈列印出7天-->
    <table class="table table-hover">
        <thead class="thead-dark">

        <label class="row justify-content-center"><strong>COVID-19 確診數據</strong></label>
        <tr>
            <th>日期</th>
            <th>國家</th>
            <th>地區</th>
            <th>總確診</th>
            <th>新增確診</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>{{$onede[$puls]['a04']}}</td>
            <td>{{$onede[$puls]['a03']}}</td>
            <td>{{$onede[$puls]['a02']}}</td>
            <td>{{$onede[$puls]['a05']}}</td>
            <td>{{$onede[$puls]['a07']}}</td>
        </tr>

        </tbody>

    </table>


@endsection
