@extends('layouts.app')

@section('content')
<div class="container">
    <div class="panel panel-default col-md-10 col-md-offset-1">
        <div class="panel-heading">
            <h4>
                <i class="glyphicon glyphicon-edit"></i> 編輯自介
            </h4>
        </div>
        @include('common.error')
        <div class="panel-body">
            <form action="{{ route('users.update',$user->id) }}" method="POST" accept-charset="UTF-8"
            enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <div class="form-group">
                    <label for="name-field">用戶名稱</label>
                    <input class="form-control" type="text" name="name" id="name-field"
                    value="{{ old('name',$user->name) }}">
                </div>

                <div class="form-group">
                    <label for="email-field">Email地址</label>
                    <input class="form-control" type="text" name="email" id="email-field"
                    value="{{ old('email',$user->email) }}">
                </div>

                <div class="form-group">
                    <label for="introduction_field">個人簡介</label>
                    <textarea name="introduction" id="introduction_field" class="form-control"
                    rows="5">{{ old('introduction',$user->introduction) }}</textarea>
                </div>

                <div class="form-group">
                    <label for="avatar-field" class="avatar-label">用戶頭像</label>
                    <input type="file" name="avatar">
                    @if($user->avatar)
                        <br>
                        <img class="thumbnail img-responsive" src="{{ $user->avatar }}" width="200px"
                        alt="{{ $user->name.'頭像' }}">
                    @endif
                </div>
                <div class="well well-sm">
                    <button type="submit" class="btn btn-primary">保存</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection