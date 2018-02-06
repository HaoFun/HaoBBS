@if(count($posts))
    <ul class="media-list">
        @foreach($posts as $post)
            <li class="media">
                <div class="media-left">
                    <a href="{{ route('users.show', [$post->user_id]) }}">
                        <img class="media-object img-thumbnail" style="width: 52px;height: 52px"
                        src="{{ $post->user->avatar }}" title="{{ $post->user->name }}">
                    </a>
                </div>

                <div class="media-body">
                    <div class="media-heading">
                        <a href="{{ route('posts.show', [$post->id]) }}" title="{{ $post->title }}">
                            {{ $post->title }}
                        </a>
                        <a class="pull-right" href="{{ route('posts.show',[$post->id]) }}">
                            <span class="badge">{{ $post->reply_count }}</span>
                        </a>
                    </div>

                    <div class="media-body meta">
                        <a href="#" title="{{ $post->topic->name }}">
                            <span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span>
                            {{ $post->topic->name }}
                        </a>
                        <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                        <a href="{{ route('users.show', [$post->user_id]) }}" title="{{ $post->user->name }}">
                            <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                            {{ $post->user->name }}
                        </a>
                        <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                        <span class="glyphicon glyphicon-time" aria-hidden="true"></span>
                        <span class="timeago" title="最後發表於">{{ $post->updated_at->diffForHumans() }}</span>
                    </div>
                </div>
            </li>
            @if(!$loop->last)
                <hr>
            @endif
        @endforeach
    </ul>
@else
    <div class="empty-block">
        查無資料
    </div>
@endif