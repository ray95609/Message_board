@extends('layouts.app')

@section('content')

<style>
    .main{
        margin: auto;
        width: 800px;
        height: 180px;
        box-shadow: darkgray 5px 5px 10px;
        border-radius: 10px;

    }

    .pickpack{
        float: left;
        margin:50px 50px 20px 80px ;
    }

    .pick{
        border-radius: 30px;
    }

    .calendar{
        margin:50px auto;
        width: 800px;
        height: 500px;
        box-shadow: darkgray 5px 5px 10px;
        border-radius:0px 0px 20px 20px;

    }

    .choice{
        cursor: pointer;

    }

</style>

@if(Session::has('success'))
    <div class="alert alert-info" role="alert">
        <strong>{{Session('success')}}</strong>
    </div>
@endif
@if(Session::has('fail'))
    <div class="alert alert-info" role="alert">
        <strong>請選擇其他時間或設計師</strong>
    </div>
@endif
@if(Session::has('nohistory'))
    <div class="alert alert-info" role="alert">
        <strong>無預約紀錄</strong>
    </div>
@endif
    <div class="main row ">
        <form  action="{{route('reserve_example.create')}}" method="POST"  >
            @csrf
            <div class="pickpack ">
                <h5>請選擇日期</h5>
               <select class="pick col  mb-3 date_pick" id="date" name="date">
                    <option  class="date" value="{{$sevenday[0]}}">{{date('m-d',strtotime($sevenday[0]))}}</option>
                </select>
            </div>
            <div class="pickpack ">
                <h5>請選擇時間</h5>
                <select class="pick col  mb-3 time_pick"  id="time" name="time">
                    <option class="time" value="{{$workTime[0]}}">{{$workTime[0]}}</option>
                </select>
            </div>
            <div class="pickpack ">
                <h5>請選擇設計師</h5>
                <select class="pick col  mb-3" id="designer" name="designer" >
                    <option value="Alsa">Alsa</option>
                    <option value="Mollly">Mollly</option>
                    <option value="Aiel">Aiel</option>
                </select>
            </div>
            <div class="submit row justify-content-center">
                <button type="submit" class="btn btn-dark">預約</button>
            </div>
        </form>

    </div>

    <div class="calendar">
        <table class="table">
            <thead>
            <tr>
                <th scope="col"> </th>
                {{-- 裡面只有七天就不需要用 for 在打死 7  --}}
{{--                @for($i=0;$i<7;$i++)--}}
{{--                    <th scope="col">{{$sevenday[$i]->format('m-d')}}</th>--}}
{{--                @endfor--}}
                @foreach($sevenday as $date)
                    <th scope="col">{{date('m-d',strtotime($date))}}</th>
                @endforeach
            </tr>

            </thead>
            <tbody>
            @foreach($workTime as $time)
            <tr>
                <th scope="row">{{$time}}</th>
                @foreach($sevenday as $day)

                    <?php
                        /**
                         * 過於複雜的blade參數  可以利用PHP 區塊這樣寫 方便閱讀
                         * @var mixed $time
                         * @var mixed $day
                         * @var mixed $checkDateTime
                         */
                        $dateTime = $day.$time;
                        $class = in_array($dateTime,$checkDateTime)?"btn-danger":"btn-dark";
                        $text = in_array($dateTime,$checkDateTime)?"額滿":"預約";
                    ?>

                    <td class="choice">
                        <button data-date="{{$day}}" data-time="{{$time}}" class="{{$dateTime}} tt btn {{$class}} " >{{$text}}
                    </td>
                @endforeach
            </tr>
            @endforeach
            </tbody>
        </table>

    </div>
<div class="m-2 row justify-content-end">
    <a href="{{route('reserve.history',['user_id'=>Auth::id()])}}" ><button class="btn-outline-info">查看預約紀錄</button></a>
</div>

<div class="row offset-md-6">
    <a href="{{route('posts.index')}}" class="btn btn-info">返回</a>
</div>

<script>
    $(".tt").click(function (e){
            e.preventDefault();

            let date=$(this).data('date');
            let time=$(this).data('time');
            $(".date").val(date);
            $(".time").val(time);
            $(".date").text(date);
            $(".time").text(time);
            //測試用
            /*let data_date=$(".date").attr("value")
            let data_time=$(".time").attr("value")
            alert(data_date+':'+data_time);*/

    });



</script>

@endsection
