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
@if(Session::has('fail'))
    <div class="alert alert-info" role="alert">
        <strong>請選擇其他時間或設計師</strong>
    </div>
@endif
    <div class="main row ">
        <form  action="{{route('reserve.create')}}" method="POST"  >
            @csrf
            <div class="pickpack ">
                <h5>請選擇日期</h5>
               <select class="pick col  mb-3 date_pick" id="date" name="date">
                    <option  class="date" value="{{$sevenday[0]->format('Y-m-d')}}">{{$sevenday[0]->format('Y-m-d')}}</option>
                </select>
            </div>
            <div class="pickpack ">
                <h5>請選擇時間</h5>
                <select class="pick col  mb-3 time_pick"  id="time" name="time">
                    <option class="time" value="{{$workTime[0]->format('H:i')}}">{{$workTime[0]->format('H:i')}}</option>
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
                @for($i=0;$i<7;$i++)
                <th scope="col">{{$sevenday[$i]->format('m-d')}}</th>
                @endfor
            </tr>

            </thead>
            <tbody>
            @foreach($workTime as $time)
            <tr>
                <th scope="row">{{$time->format('H:i')}}</th>
                @foreach($sevenday as $day)

                <td class="choice"><button data-date="{{$dayF=$day->format('Y-m-d')}}" data-time="{{$timeF=$time->format('H:i')}}"
                                           class="{{$dateTime=$dayF.$timeF}}
                                           tt btn @if(in_array($dateTime,$checkDateTime))btn-danger @endif
                                                         @if(!in_array($dateTime,$checkDateTime)) btn-dark @endif "  >
                                                         @if(in_array($dateTime,$checkDateTime))額滿@endif
                                                         @if(!in_array($dateTime,$checkDateTime))預約@endif</button></td>
                @endforeach
            </tr>
            @endforeach
            </tbody>
        </table>

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
