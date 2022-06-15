

@extends('layouts.app')

@section('content')


    <!--接下來要存入資料庫  再讀出來  稍微研究一下boostrap-->
    <!--迴圈列印出7天-->
    @if(Session::has('DB'))
    <div class="alert alert-info" role="alert">
        <strong>今日確診數據是從資料庫抓出來的</strong>
    </div>
    @endif
    <table class="table table-hover">
        <thead class="thead-dark">

        <label class="row justify-content-center"><strong>COVID-19 今日確診數據</strong></label>
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
            @if(Session::has('DB'))
            @foreach($select as $key=>$rows)
            <td>{{$rows->date}}</td>
            <td>{{$rows->country}}</td>
            <td>{{$rows->local}}</td>
            <td class="animation">{{$rows->total_diagnose}}</td>
            <td>{{$rows->curdate_diagnose}}</td>
            @endforeach
            @endif
        </tr>
            @if(Session::has('API'))
            <tr>
                <td>{{$onede['a04']}}</td>
                <td>{{$onede['a03']}}</td>
                <td>{{$onede['a02']}}</td>
                <td>{{$onede['a05']}}</td>
                <td>{{$onede['a07']}}</td>
            </tr>
            @endif
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
        {{--asort倒敘的排列--}}
        {{asort($sevende)}}
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
    <div class="offset-md-6">
        <a href="{{route('posts.index')}}" class="btn btn-info">返回</a>
    </div>
@endsection
