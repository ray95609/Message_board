

@extends('layouts.app')

@section('content')



    <h5>COVID-19 確診數據</h5>
    <p>日期:{{$onede[1]['a04']}}</p>
    <p>國家:{{$onede[1]['a03']}}</p>
    <p>地區:{{$onede[1]['a02']}}</p>
    <p>總確診:{{$onede[1]['a05']}}</p>
    <p>新增確診:{{$onede[1]['a06']}}</p>
    <p>解除隔離:{{$onede[1]['a31']}}</p>
    <p>總人口:{{$onede[1]['a28']}}</p>





@endsection
