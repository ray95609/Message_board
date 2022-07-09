@extends('layouts.app')

@section('content')

    <style>
        .main{
            width: 300px;
            height: 200px;
            margin: auto;
            box-shadow: gray 10px 10px 10px;
            border-radius: 20px;
        }

        .con{
            margin:25px 0 50px 0px;

        }


    </style>

    <div class="main">
        <form action="{{route('excel.importUpload')}}" method="POST"  enctype="multipart/form-data">
            @csrf
            <div class="col offset-sm-2"><h2>選擇匯入檔案</h2></div>
            <div class="col offset-sm-2"><input type="file" name="file" class="con  "></div>
            <div class="col offset-sm-4"><button type="submit"  class="btn btn-primary" class="con">確定匯入</button></div>

        </form>
    </div>


@endsection
