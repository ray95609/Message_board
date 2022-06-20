
{{-- 繼承預設版型為什麼沒有php開頭? --}}

@extends('layouts.app')


@section('content')
    @if(Session::has('nouser'))
        <div class="alert alert-info" role="alert">
            <strong>請先登入才能回覆</strong>
        </div>
    @endif

    <div class="dropdown m-3 row justify-content-end">
        <form class="form-inline" role="search" action="{{route('posts.index_example')}}" method="GET" >

            <div class="form-group">
                <input name="keyword" id="keyword" class="form-control mr-sm-2" type="text" placeholder="文章名稱" value="{{request()->input('keyword')}}">
            </div>

            <div class="form-group">
                {{-- 注意 --}}
               <select class="form-control form-select" name="sort">
                   <option value="">請選擇排序</option>
                   <option value="old" @if(request()->input('sort')=="old") selected @endif>較早文章</option>
                   <option value="new" @if(request()->input('sort')=="new") selected @endif>最新文章</option>
                   <option value="update" @if(request()->input('sort')=="update") selected @endif>最新編輯</option>
               </select>
            </div>
            <div class="form-group">
                <button class="btn btn-primary ml-2" type="submit" >查詢</button>
            </div>
        </form>
{{--        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">--}}
{{--            選取排序--}}
{{--        </button>--}}
{{--        <div class="dropdown-menu">--}}
{{--            <a class="dropdown-item" href="#">較早文章</a>--}}
{{--            <a class="dropdown-item" href="#">最新文章</a>--}}
{{--            <a class="dropdown-item" href="#">最新編輯</a>--}}
{{--        </div>--}}

    </div>


    <div class="card-header">
    文章列表
    <a href="{{route('posts.create')}}" class="float-right btn btn-primary">新增文章</a>
</div>


<table class="table table-hover">
    <thead>{{--標頭標籤--}}

    <tr>

        <th> 文章編號</th>
        <th> 文章時間</th>
        <th> 文章標題</th>
        <th> 作者</th>
        <th> 內容</th>
    </tr>
    </thead>

    <tbody>{{--table內容標籤--}}
    @foreach($allPosts as $key => $rows) {{--意思是把所有文章列表的陣列，取出來塞進去?--}}
        <tr>
            <td >{{$key+1}} </td>
            <td >{{$rows->created_at}} </td>
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
{{-- 注意 --}}
<div class="row">{!! $allPosts->appends(request()->query())->links() !!}</div>

    <div class="m-2 row justify-content-end">
        <a href="{{route('guzzle.index')}}" ><button class="btn-outline-info">每日確診人數</button></a>
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

