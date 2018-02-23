<?PHP

namespace App\Observers;

use App\Models\Reply;
use App\Notifications\PostReplied;

class ReplyObserver
{
    public function creating(Reply $reply)
    {
        //過濾XSS
        $reply->content = clean($reply->content,'user_post_body');
    }

    public function created(Reply $reply)
    {
        $post = $reply->post;
        $post->increment('reply_count',1);
        $post->user->notify(new PostReplied($reply));
    }

    public function deleted(Reply $reply)
    {
        $reply->post->decrement('reply_count',1);
    }
}