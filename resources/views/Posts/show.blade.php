
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
                <button type="submit" class="btn btn-primary">送出</button>
                <a href="{{route('posts.index')}}" class="btn btn-info">返回</a>
            </div>


    </div>










@endsection
