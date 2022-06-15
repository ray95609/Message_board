
{{-- 繼承預設版型為什麼沒有php開頭? --}}

@extends('layouts.app')


@section('content')
    <div class="m-3 row justify-content-end"><a href="{{route('guzzle.index')}}" ><button class="btn-outline-info">每日確診人數</button></a></div>

<div class="card-header">
    文章列表
    <a href="{{route('posts.create')}}" class="float-right btn btn-primary">新增文章</a>
</div>


<table class="table table-hover">
    <thead>{{--標頭標籤--}}
    <tr>
        <th> 文章編號</th>
        <th> 文章標題</th>
        <th> 作者</th>
        <th> 內容</th>
    </tr>
    </thead>

    <tbody>{{--table內容標籤--}}
    @foreach($allPosts as $key => $rows) {{--意思是把所有文章列表的陣列，取出來塞進去?--}}
        <tr>
            <td >{{$key+1}} </td>
            <td data-id="{{$rows->id}}" class="show-data"
                style="cursor: pointer"
                >{{$rows->post_name}} </td>
            <td >{{$rows->name}} </td>
            <td >{{$rows->post_content}}</td>
            @if(Auth::user() && Auth::id() ==$rows->post_user_id)
                <td>
                <a href="{{route('posts.edit',['id'=>$rows->id])}}" class="btn btn-success btn-sm mt-sm-1" >編輯</a>
                    <button
                            data-url="{{route('posts.delete',['post_id'=>$rows->id])}}"
                            class="btn btn-danger btn-sm mt-sm-1 deleteButton">刪除</button>
                </td>
            @endif
        </tr>
    @endforeach
    </tbody>
</table>
<div class="row">{!! $allPosts->links() !!}</div>



<!--axios.js & fetch  非同步請求的另外套件-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript">



        $(".show-data").click(function(){
            let id=$(this).data('id');

            let ajaxUrl = "/posts/show/"+id;
            location.href=ajaxUrl;
        });

        $(".deleteButton").on('click',function(){

            let ajaxUrl = $(".deleteButton").data('url');

            $.ajax(
                ajaxUrl, {
                    type: 'DELETE',
                    data: {
                        "_token": "{{csrf_token()}}",
                    },
                    success: function (result) {
                        if(result.code==='success'){
                            alert('Delete Success')
                            location.reload();
                        }else{
                            alert('Delete Fail');
                        }
                    }
                });

        })

</script>


@endsection

