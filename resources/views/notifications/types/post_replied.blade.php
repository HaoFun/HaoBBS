<div class="media">
    <div class="avatar pull-left">
        <a href="{{ route('users.show',$notification->data['user_id']) }}">
            <img class="media-object img-thumbnail" alt="{{ $notification->data['user_name'] }}"
                src="{{ $notification->data['user_avatar'] }}" style="width: 48px;height: 48px">
        </a>
    </div>

    <div class="infos">
        <div class="media-heading">
            <a href="{{ route('users.show',$notification->data['user_id']) }}">
                {{ $notification->data['user_name'] }}
            </a>
            回覆了
            <a href="{{ $notification->data['post_link'] }}">
                {{ $notification->data['post_title'] }}
            </a>

            <span class="meta pull-right" title="{{ $notification->created_at }}">
                {{ $notification->created_at->diffForHumans() }}
            </span>
        </div>
        <div class="reply-content">
            {!! $notification->data['reply_content'] !!}
        </div>
    </div>
</div>
<hr>