@extends('layouts.app')


@section('content')

    <style>
        .main{
            margin: auto;
            padding: 0px;
            width: 80%;
            height: 80%;
            box-shadow: darkgray 5px 5px 10px;
            border-radius: 10px;


        }

    </style>

    <div class="main">
        <table class="table table-hover">
         <thead class="thead-dark">
            <label class="col-sm-12 col-form-label row justify-content-center "><h3>預約紀錄</h3></label>
            <tr>
                <th scope="col">#</th>
                <th scope="col">預約者</th>
                <th scope="col">預約日期</th>
                <th scope="col">預約時段</th>
                <th scope="col">預約設計師</th>
                <th scope="col">何時預約</th>
            </tr>
         </thead>
         <tbody>
         @foreach($history as $key => $row)
         <tr>

             <th scope="row">{{$key+1}}</th>
                <td>{{$row->name}}</td>
                <td>{{$row->date}}</td>
                <td>{{$row->time}}</td>
                <td>{{$row->designer}}</td>
                <td>{{$row->created_at}}</td>

         </tr>
         @endforeach
         </tbody>
        </table>
        <div class="row justify-content-center">{!! $history->links() !!}</div>
    </div>

    <div class="offset-md-10">
        <a href="{{route('reserve.index')}}" class="btn btn-info">返回</a>
    </div>

@endsection
