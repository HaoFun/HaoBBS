@extends('layouts.app')

@section('title','文章列表')

@section('content')
    <div class="row">
        <div class="col-lg-9 col-md-9 post-list">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <ul class="nav nav-pills">
                        <li role="presentation" class="active"><a href="#">最後回覆</a></li>
                        <li role="presentation"><a href="#">最新發佈</a></li>
                    </ul>
                </div>

                <div class="panel-body">
                    {{--文章列表--}}
                    @include('posts.post_list',['posts' => $posts])
                    {{--分頁--}}
                    {!! $posts->render() !!}
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-3 sidebar">
            @include('posts.sidebar')
        </div>
    </div>
@endsection