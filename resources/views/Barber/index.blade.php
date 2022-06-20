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
            margin-top:3%;
            margin-bottom: 3%;
        }

        .lm{

            position: fixed;
            right: 3%;
            margin-top: 20%;


        }

        .ll{

        }




    </style>
    <div class="lm " >
       <a href="{{route('barber.history')}}"> <button class="btn btn-secondary ll">查看預約紀錄</button></a>

    </div>
    <div class="main">
        <form action="{{route('barber.reserve')}}" method="POST">
        <h4>選擇預約日期</h4>
        <select class="form-control mm">
            <option>6/21</option>
            <option>6/22</option>
            <option>6/23</option>
            <option>6/24</option>
            <option>6/25</option>
            <option>6/26</option>
            <option>6/27</option>
        </select>
        <h4>選擇預約時段</h4>
        <select class="form-control mm">
            <option>12:00~13:00</option>
            <option>13:00~14:00</option>
            <option>14:00~15:00</option>
            <option>16:00~17:00</option>
            <option>17:00~18:00</option>
            <option>18:00~19:00</option>
            <option>19:00~20:00</option>
            <option>20:00~21:00</option>
        </select>
        <h4>選擇預約美髮師</h4>
        <select class="form-control mm">
            <option>Formosa</option>
            <option>Taiwan</option>
            <option>R.O.C</option>
        </select>
            <div class="row justify-content-center ">
                <input class="btn btn-default " type="submit" value="Submit">
            </div>

        </form>
    </div>



@endsection
