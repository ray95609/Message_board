
{{-- 繼承預設版型為什麼沒有php開頭? --}}

@extends('layouts.app')

@section('content')

<style>


</style>

<script>



</script>

{{--為什麼不用寫head、body、html標籤--}}
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
            <td data-id="{{$rows->id}}" class="show-data">{{$key+1}} </td>
            <td data-id="{{$rows->id}}" class="show-data">{{$rows->post_name}} </td>
            <td data-id="{{$rows->id}}" class="show-data">{{$rows->name}} </td>
            <td data-id="{{$rows->id}}" class="show-data">{{$rows->post_content}}</td>
            @if(Auth::user() && Auth::id() ==$rows->post_user_id)
                <td>
                <a href="{{route('posts.edit',['id'=>$rows->id])}}" class="btn btn-success btn-sm mt-sm-1" >編輯</a>
                </td>
            @endif
        </tr>
    @endforeach
    </tbody>

</table>

@endsection

