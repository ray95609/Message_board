@extends('layouts.app')


@section('content')

<div class="card-header">新增文章</div>

<div class="card-body">

    <form method="POST" action="{{route('posts.store')}}">
    @csrf
    <div class="form-group">
     <label class="col-md-1 col-form-label text-md-right">文章標題</label>
        <div class="col-md-4">
            <input id="post_name" name="post_name" type="text" class="form-control">
        </div>
    </div>

    <div>
        <label class="col-md-1 col-form-label text-md-right">文章內容</label>
        <textarea class="form-control" name="post_content" id="post_content" rows="15" ></textarea>
    </div>
    <div class="offset-md-6">
        <button type="submit" class="btn btn-primary">送出</button>
        <a href="{{route('posts.index')}}" class="btn btn-info">返回</a>
    </div>

    </form>

</div>


@endsection
