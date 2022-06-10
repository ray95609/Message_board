
@extends('layouts.app')

@section('content')


    <div class="card-header">查看文章</div>

    <div class="card-body" style="border: thick double #32a1ce;">

            <div class="form-group">
                <label class="col-md-1 col-form-label text-md-right">文章標題</label>
                <div class="col-md-1 col-form-label text-md-right">
                    <h6>{{$onePost->post_name}}</h6>
                </div>
            </div>

            <div>
                <label class="col-md-1 col-form-label text-md-right">文章內容</label>
                <article class="col-md-5 col-form-label text-md-right">{{$onePost->post_content}}</article>
            </div>
            <div class="offset-md-6">
                <a href="{{route('posts.index')}}" class="btn btn-info">返回</a>
            </div>
                <a href="{{route('posts.re',$onePost->post_id)}}" class="float-right btn btn-primary">回覆文章</a>


    </div>
    @foreach($repost as $key =>$rows)
    <div class="card-body" style="border:thick double #2d995b;">
        <div class="form-group">
            <label class="col-md-1 col-form-label text-md-right">回覆標題</label>
            <label class="col-md-1 col-form-label text-md-right">回覆者:{{$rows->name}}</label>
            <div class="col-md-1 col-form-label text-md-right">
                <h6>{{$rows->repost_name}}</h6>
            </div>
        </div>

        <div>
            <label class="col-md-1 col-form-label text-md-right">文章內容</label>
            <article class="col-md-5 col-form-label text-md-right">{{$rows->repost_content}}</article>
        </div>


    </div>
    @endforeach
    <div class="offset-md-6">
        <a href="{{route('posts.index')}}" class="btn btn-info">返回</a>
    </div>








@endsection
