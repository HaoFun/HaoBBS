@if(count($replies))
<ul class="list-group">
    @foreach($replies as $reply)
        <li class="list-group-item">
            <a href="{{ $reply->post->link(['#reply'.$reply->id]) }}">
                {{ $reply->post->title }}
            </a>

            <div class="reply-content" style="margin: 6px 0">
                {!! $reply->content !!}
            </div>

            <div class="meta">
                <span class="glyphicon glyphicon-time" aria-hidden="true">
                    回覆於 {{ $reply->created_at->diffForHumans() }}</span>
            </div>
        </li>
    @endforeach
</ul>
@else
    <div class="empty-block">
        查無資料
    </div>
@endif
{{--分頁--}}
{{-- \Illuminate\Support\Facades\Request::except() 這會在URL中請求的參數得到繼承 --}}
{!! $replies->appends(Request::except('page'))->render() !!}