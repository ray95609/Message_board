@extends('layouts.app')

@section('content')

<style>
    .main{
        margin: auto;
        width: 600px;
        height: 180px;
        box-shadow: darkgray 5px 5px 10px;
        border-radius: 10px;

    }

    .pickpack{
        float: left;
        margin:50px 50px 20px 50px ;
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
                    <option class="date" value="06/25">06/25</option>

                </select>
            </div>
            <div class="pickpack ">
                <h5>請選擇時間</h5>
                <select class="pick col  mb-3 time_pick" >
                    <option class="time" value="1">11~12</option>

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
                <th scope="col">06/25</th>
                <th scope="col">06/26</th>
                <th scope="col">06/27</th>
                <th scope="col">06/28</th>
                <th scope="col">06/29</th>
                <th scope="col">06/30</th>
                <th scope="col">07/01</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <th scope="row">11~12</th>
                <td class="choice"><button class="btn btn-dark tt" data-date="06/25" data-time="11~12">預約</button></td>
                <td class="choice"><button class="btn btn-dark tt" data-date="06/26" data-time="11~12">預約</button></td>
                <td class="choice"><button class="btn btn-dark tt" data-date="06/27" data-time="11~12">預約</button></td>
                <td class="choice"><button class="btn btn-dark tt" data-date="06/28" data-time="11~12">預約</button></td>
                <td class="choice"><button class="btn btn-dark tt" data-date="06/29" data-time="11~12">預約</button></td>
                <td class="choice"><button class="btn btn-dark tt" data-date="06/30" data-time="11~12">預約</button></td>
                <td class="choice"><button class="btn btn-dark tt" data-date="07/01" data-time="11~12">預約</button></td>
            </tr>
            <tr>
                <th scope="row">12~13</th>
                <td class="choice"><button class="btn btn-dark tt" data-date="06/25" data-time="12~13">預約</button></td>
                <td class="choice"><button class="btn btn-dark tt" data-date="06/26" data-time="12~13">預約</button></td>
                <td class="choice"><button class="btn btn-dark tt" data-date="06/27" data-time="12~13">預約</button></td>
                <td class="choice"><button class="btn btn-dark tt" data-date="06/28" data-time="12~13">預約</button></td>
                <td class="choice"><button class="btn btn-dark tt" data-date="06/29" data-time="12~13">預約</button></td>
                <td class="choice"><button class="btn btn-dark tt" data-date="06/30" data-time="12~13">預約</button></td>
                <td class="choice"><button class="btn btn-dark tt" data-date="07/01" data-time="12~13">預約</button></td>

            </tr>
            <tr>
                <th scope="row">13~14</th>
                <td class="choice"><button class="btn btn-dark">預約</button></td>
                <td class="choice"><button class="btn btn-dark">預約</button></td>
                <td class="choice"><button class="btn btn-dark">預約</button></td>
                <td class="choice"><button class="btn btn-dark">預約</button></td>
                <td class="choice"><button class="btn btn-dark">預約</button></td>
                <td class="choice"><button class="btn btn-dark">預約</button></td>
                <td class="choice"><button class="btn btn-dark">預約</button></td>

            </tr>
            <tr>
                <th scope="row">14~15</th>
                <td class="choice"><button class="btn btn-dark">預約</button></td>
                <td class="choice"><button class="btn btn-dark">預約</button></td>
                <td class="choice"><button class="btn btn-dark">預約</button></td>
                <td class="choice"><button class="btn btn-dark">預約</button></td>
                <td class="choice"><button class="btn btn-dark">預約</button></td>
                <td class="choice"><button class="btn btn-dark">預約</button></td>
                <td class="choice"><button class="btn btn-dark">預約</button></td>
            </tr>
            <tr>
                <th scope="row">15~16</th>
                <td class="choice"><button class="btn btn-dark">預約</button></td>
                <td class="choice"><button class="btn btn-dark">預約</button></td>
                <td class="choice"><button class="btn btn-dark">預約</button></td>
                <td class="choice"><button class="btn btn-dark">預約</button></td>
                <td class="choice"><button class="btn btn-dark">預約</button></td>
                <td class="choice"><button class="btn btn-dark">預約</button></td>
                <td class="choice"><button class="btn btn-dark">預約</button></td>
            </tr>
            <tr>
                <th scope="row">16~17</th>
                <td class="choice"><button class="btn btn-dark">預約</button></td>
                <td class="choice"><button class="btn btn-dark">預約</button></td>
                <td class="choice"><button class="btn btn-dark">預約</button></td>
                <td class="choice"><button class="btn btn-dark">預約</button></td>
                <td class="choice"><button class="btn btn-dark">預約</button></td>
                <td class="choice"><button class="btn btn-dark">預約</button></td>
                <td class="choice"><button class="btn btn-dark">預約</button></td>
            </tr>
            <tr>
                <th scope="row">17~18</th>
                <td class="choice"><button class="btn btn-dark">預約</button></td>
                <td class="choice"><button class="btn btn-dark">預約</button></td>
                <td class="choice"><button class="btn btn-dark">預約</button></td>
                <td class="choice"><button class="btn btn-dark">預約</button></td>
                <td class="choice"><button class="btn btn-dark">預約</button></td>
                <td class="choice"><button class="btn btn-dark">預約</button></td>
                <td class="choice"><button class="btn btn-dark">預約</button></td>
            </tr>




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
