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
                <th scope="col">訂單編號</th>
                <th scope="col">預約者</th>
                <th scope="col">預約日期</th>
                <th scope="col">預約時段</th>
                <th scope="col">預約設計師</th>
                <th scope="col">何時預約</th>
                <th scope="col">取消預約</th>

            </tr>
         </thead>
         <tbody>
         @foreach($history as $key => $row)
         <tr>

             <th scope="row">{{$key+1}}</th>
                <td>{{$row->reserve_id}}</td>
                <td>{{$row->name}}</td>
                <td>{{$row->date}}</td>
                <td>{{$row->time}}</td>
                <td>{{$row->designer}}</td>
                <td>{{$row->created_at}}</td>
             @if(Auth::id() && Auth::id()==$row->id)
                <td><button class="btn btn-danger cancel_button"
                            data-url="{{route('reserve.cancel',['user_id'=>$row->id,'reserve_id'=>$row->reserve_id])}}"
                            data-id="{{$row->reserve_id}}">Cancel</button></td>
             @endif


         </tr>
         @endforeach
         </tbody>
        </table>
        <div class="row justify-content-center">{!! $history->links() !!}</div>
    </div>

    <div class="offset-md-8">
        <a href="{{route('excel.userexport',['user_id'=>Auth::id()])}}" class="row  btn btn-info" style="margin-right: 20%">預約記錄匯出</a>
        <a href="{{route('reserve.index')}}" class="row btn btn-info" >返回</a>
    </div>



    <script>

        $('.cancel_button').on('click',function (){

            let ajaxUrl=$(this).data('url');
            let reserve_id=$(this).data('id');

                $.ajax(
                    ajaxUrl,
                    {
                        type:'PUT',
                        data:{"_token":"{{csrf_token()}}" },
                        success:function (result){
                            if(result.code==='success'){
                                alert('訂單編號:'+reserve_id+'\n'+'預約取消成功')
                                location.reload();
                            }else {
                                alert('預約取消失敗')

                            }

                        }
                    }
                )

            }
        )




    </script>

@endsection
