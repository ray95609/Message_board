


@extends('layouts.app')


@section('content')
    <style>
        .main{
            margin: auto;
            width: 800px;
            border-radius: 5px;
            box-shadow: gray 10px 10px 10px;

        }

        .article{
            width: 200px;
            height: 60px;
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 2;
            box-sizing:border-box;

        }

    </style>


    @if(Session::has('nouser'))
        <div class="alert alert-info" role="alert">
            <strong>請先登入才能回覆</strong>
        </div>
    @endif
    <div class="main">
    <div class="dropdown m-3 row justify-content-end">
        <form class="form-inline" role="search" action="{{route('posts.search')}}" method="GET" >

            <div class="form-group">
                <input name="keyword" id="keyword" class="form-control mr-sm-2" type="text" placeholder="輸入查詢條件">
            </div>
            <button class="btn my-2 my-sm-0" type="submit" style="background:none; margin-left:-3rem; color:#ff9d00;" ></button>
        </form>
        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            文章排序
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <a class="dropdown-item" href="{{route('posts.SortByOld')}}">較早文章</a>
            <a class="dropdown-item" href="{{route('posts.SortByNew')}}">最新文章</a>
            <a class="dropdown-item" href="{{route('posts.SortByUpdate')}}">最新編輯</a>
        </div>
    </div>

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
        <th>編輯</th>
    </tr>
    </thead>

    <tbody>{{--table內容標籤--}}
    @foreach($allPosts as $key => $rows) {{--意思是把所有文章列表的陣列，取出來塞進去?--}}
        <tr>
            <td >{{$key+1}} </td>
            <td data-id="{{$rows->id}}" class="show-data article  "
                style="cursor: pointer"
                >{{$rows->post_name}} </td>
            <td >{{$rows->name}} </td>
            <td class="article">{{$rows->post_content}}</td>
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

    <div class="m-2 row justify-content-end">
        <a href="{{route('reserve.index')}}" ><button class="btn-outline-info">預約系統</button></a>
        <a href="{{route('guzzle.index')}}" ><button class="btn-outline-info">每日確診人數</button></a>
    </div>
</div>
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

