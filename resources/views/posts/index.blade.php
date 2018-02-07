@extends('layouts.app')

@section('title',isset($topic) ? $topic->name:'文章列表')

@section('content')
    <div class="row">
        <div class="col-lg-9 col-md-9 post-list">

            @if(isset($topic))
                <div class="alert alert-info" role="alert">
                    {{ $topic->name }} : {{ $topic->description }}
                </div>
            @endif

            <div class="panel panel-default">
                <div class="panel-heading">
                    <ul class="nav nav-pills">
                        <li class="{{ active_class( !if_query('order', 'recent')) }}"><a href="{{ Request::url().'?order=default' }}">最後回覆</a></li>
                        <li class="{{ active_class( if_query('order', 'recent')) }}"><a href="{{ Request::url().'?order=recent' }}">最新發佈</a></li>
                    </ul>
                </div>

                <div class="panel-body">
                    {{--文章列表--}}
                    @include('posts.post_list',['posts' => $posts])
                    {{--分頁--}}
                    {!! $posts->appends(['order' => isset($_GET['order'])? $_GET['order']:'default'])->render() !!}
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-3 sidebar">
            @include('posts.sidebar')
        </div>
    </div>
@endsection