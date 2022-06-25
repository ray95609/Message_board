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

    <div class="main row ">
        <form  action="" method="POST"  >
            <div class="pickpack ">
                <h5>請選擇日期</h5>
               <select class="pick col  mb-3 date_pick" >
                    <option class="date" value="06/25">{{$sevenday[0]->format('Y-m-d')}}</option>

                </select>
            </div>
            <div class="pickpack ">
                <h5>請選擇時間</h5>
                <select class="pick col  mb-3 time_pick" >
                    <option class="time" value="1">{{$workTime[0]->format('H:i')}}</option>

                </select>
            </div>
            <div class="pickpack ">
                <h5>請選擇設計師</h5>
                <select class="pick col  mb-3" >
                    <option value="1">Alsa</option>
                    <option value="2">Mollly</option>
                    <option value="3">Aiel</option>

                </select>
            </div>
            <div class="submit row justify-content-center">
                <input type="submit" value="預約">
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
            @for($i=0;$i<7;$i++)
            <tr>
                <th scope="row">{{$workTime[$i]->format('H:i')}}</th>
                @for($j=0;$j<7;$j++)
                <td class="choice"><button class="btn btn-dark tt" data-date="{{$sevenday[$j]->format('Y-m-d')}}" data-time="{{$workTime[$i]->format('H:i')}}">預約</button></td>
                @endfor
            </tr>
            @endfor
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

            for(i=1;i<7;i++){
                $(".date_pick option[index='1']").remove();

                $(".time_pick option[index='1']").remove();
                }



        //測試用
        /*let data_date=$(".date").attr("value")
        let data_time=$(".time").attr("value")
        alert(data_date+':'+data_time);*/

        });



</script>

@endsection
