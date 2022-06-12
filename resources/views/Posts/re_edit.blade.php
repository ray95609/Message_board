
@extends('layouts.app')


@section('content')

    <div class="card-header">編輯回覆文章</div>

    <div class="card-body">

        <form action="{{route('posts.re_update',['id'=>$repost->post_id,'repost_id'=>$repost->id])}}" method="POST">

            @csrf
            {{-- laravel blade 簡化 方法    --}}
            {{-- <input type="hidden" name="_method" value="PUT"> --}}
            @method('PUT')
            <div class="form-group">
                <label class="col-md-1 col-form-label text-md-right">文章標題</label>
                <div class="col-md-4">
                    <input id="repost_name" name="repost_name" type="text" class="form-control" value="{{$repost->repost_name}}">
                </div>
            </div>

            <div>
                <label class="col-md-1 col-form-label text-md-right">文章內容</label>
                <textarea class="form-control" name="repost_content" id="repost_content" rows="15" >{{$repost->repost_content}}</textarea>
            </div>
            <div class="offset-md-6">
                <button type="submit" class="btn btn-primary">送出</button>
                <a href="{{route('posts.show',$repost->post_id)}}" class="btn btn-info">返回</a>
            </div>

        </form>

    </div>


@endsection
