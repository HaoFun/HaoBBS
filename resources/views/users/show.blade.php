@extends('layouts.app')

@section('title',$user->name.'個人中心')

@section('content')
<div class="row">
    <div class="col-lg-3 col-md-3 hidden-sm hidden-xs user-info">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="media">
                    <div class="text-center">
                        <img class="thumbnail img-responsive" src="{{ $user->avatar ?:asset('images/avatar/avatar.png') }}"
                        alt="{{ $user->name.'頭像' }}" width="300px" height="300px">
                    </div>
                    <div class="media-body">
                        <hr>
                        <h4><strong>個人簡介</strong></h4>
                        <p>{{ $user->introduction }}</p>
                        <hr>
                        <h4><strong>註冊於</strong></h4>
                        <p>{{ $user->created_at->diffForHumans() }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <span>
                    <h1 class="panel-title pull-left" style="font-size: 30px;">
                        {{ $user->name }}&nbsp;&nbsp;&nbsp;<small>{{ $user->email }}</small>
                    </h1>
                </span>
            </div>
        </div>
        <hr>

        {{--用戶發布的內容--}}
        <div class="panel panel-default">
            <div class="panel-body">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#">{{ $user->name."的文章" }}</a></li>
                    <li><a href="#">{{ $user->name."的回覆" }}</a></li>
                </ul>
                @include('users.posts',['posts' => $user->posts()->recent()->paginate(5)])
            </div>
        </div>
    </div>
</div>
@stop