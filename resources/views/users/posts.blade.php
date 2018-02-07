@if(count($posts))
    <ul class="list-group">
        @foreach($posts as $post)
            <li class="list-group-item">
                <a href="{{ route('posts.show',$post->id) }}">
                    {{ $post->title }}
                </a>
                <span class="meta pull-right">
                    {{ $post->reply_count }} 回覆
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    {{ $post->created_at->diffForHumans() }}
                </span>
            </li>
        @endforeach
    </ul>
@else
    <div class="empty-block">查無資料</div>
@endif

{{--分頁--}}
{!! $posts->render() !!}