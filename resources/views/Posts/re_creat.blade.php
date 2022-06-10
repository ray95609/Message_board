

@extends('layouts.app')

@section('content')


    <div class="card-header">回覆文章:{{$repost->post_name}}&emsp;&emsp;文章編號:{{$repost->id}}</div>

    <div class="card-body">

        <form method="POST" action="{{route('posts.re_store')}}">
            @csrf
            <div class="form-group">
                <label class="col-md-1 col-form-label text-md-right">回覆標題</label>
                <div class="col-md-4">
                    <input type="hidden" id="post_id" name="post_id"  value="{{$repost->id}}">
                    <input id="repost_name" name="repost_name" type="text" class="form-control">
                </div>
            </div>

            <div>
                <label class="col-md-1 col-form-label text-md-right">回覆內容</label>
                <textarea class="form-control" name="repost_content" id="repost_content" rows="15" ></textarea>
            </div>
            <div class="offset-md-6">
                <button type="submit" class="btn btn-primary">送出</button>
                <a href="{{route('posts.index')}}" class="btn btn-info">返回</a>
            </div>

        </form>

    </div>


@endsection



