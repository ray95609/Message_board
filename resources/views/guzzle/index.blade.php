

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
            <td>{{$onede['a04']}}</td>
            <td>{{$onede['a03']}}</td>
            <td>{{$onede['a02']}}</td>
            <td>{{$onede['a05']}}</td>
            <td>{{$onede['a07']}}</td>
        </tr>

        </tbody>

    </table>

    <table class="table table-hover">
        <thead class="thead-dark">

        <label class="row justify-content-center"><strong>COVID-19 最近七日</strong></label>
        <tr>
            <th>日期</th>
            <th>國家</th>
            <th>地區</th>
            <th>總確診</th>
            <th>新增確診</th>
        </tr>
        </thead>
        <tbody>
        @foreach($sevende as $key=>$rows)
        <tr>
            <td>{{$rows['a04']}}</td>
            <td>{{$rows['a03']}}</td>
            <td>{{$rows['a02']}}</td>
            <td>{{$rows['a05']}}</td>
            <td>{{$rows['a07']}}</td>
        </tr>
        @endforeach
        </tbody>

    </table>

@endsection
