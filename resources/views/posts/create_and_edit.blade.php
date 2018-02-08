@extends('layouts.app')

@section('content')

<div class="container">
    <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">
            <div class="panel-body">
                <h2 class="text-center">
                    <i class="glyphicon glyphicon-edit"></i>
                    @if($post->id)
                        編輯文章 - {{ $post->title }}
                    @else
                        新增文章
                    @endif
                </h2>
                <hr>
                @include('common.error')
                @if($post->id)
                    <form action="{{ route('posts.update',$post->id) }}" method="POST" accept-charset="UTF-8">
                        {{ method_field('PUT') }}
                @else
                    <form action="{{ route('posts.store') }}" method="POST" accept-charset="UTF-8">
                @endif
                        {{ csrf_field() }}
                        <div class="form-group">
                            <input class="form-control" type="text" name="title" value="{{ old('title',$post->title) }}"
                            placeholder="請填寫標題" required>
                        </div>

                        <div class="form-group">
                            <select class="form-control" name="topic_id" required>
                                <option value="" hidden disabled selected>請選擇主題分類</option>
                                @foreach($topics as $topic)
                                    <option value="{{ $topic->id }}" {{ $topic->id === $post->topic_id ?
                                    'selected=selected':'' }}>{{ $topic->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <textarea name="body" id="editor" class="form-control" rows="10"
                            placeholder="至少輸入三個字元" required>{{ old('body',$post->body) }}</textarea>
                        </div>

                        <div class="well well-sm">
                            <button type="submit" class="btn btn-primary">
                                <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>&nbsp;&nbsp;保存
                            </button>
                        </div>
                    </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
    <link type="text/css" rel="stylesheet" href="{{ asset('css/simditor.css') }}">
@stop

@section('scripts')
    <script type="text/javascript" src="{{ asset('js/module.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/hotkeys.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/uploader.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/simditor.js') }}"></script>
    <script>
        $(document).ready(function () {
            var editor = new Simditor({
                textarea:$('#editor'),
            });
        });
    </script>
@stop