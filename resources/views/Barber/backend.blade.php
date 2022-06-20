@extends('layouts.app')


@section('content')

    <style>
        .main{
            margin: auto;
            padding: 5%;
            width: 60%;
            height: 60%;
            border:1px solid darkgray;
            border-radius: 15px;
            box-shadow: 10px 5px 5px darkgray;

        }
        .mm{
            font-size: 200%;

        }


    </style>

        <div class=" main">
            <div class="row justify-content-around">
            <a href="{{route('barber.schedule')}}"><button type="button" class="btn btn-light mm">排班</button></a>
            <a href="{{route('barber.reserveList')}}"><button type="button" class="btn btn-light mm">查看預約清單</button></a>
            </div>


        </div>




@endsection
