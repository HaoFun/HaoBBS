@include('common.error')
<div class="reply-box">
    <form action="{{ route('replies.store') }}" method="POST" accept-charset="UTF-8">
        {{ csrf_field() }}
        <input type="hidden" name="post_id" value="{{ $post->id }}">
        <div class="form-group">
            <textarea class="form-control" name="content" rows="3" placeholder="分享你的想法"></textarea>
        </div>
        <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-share"></i>回覆</button>
    </form>
</div>