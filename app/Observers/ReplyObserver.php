<?PHP

namespace App\Observers;

use App\Models\Reply;

class ReplyObserver
{
    public function creating(Reply $reply)
    {
        //過濾XSS
        $reply->content = clean($reply->content,'user_post_body');
    }

    public function created(Reply $reply)
    {
        $reply->post->increment('reply_count',1);
    }

    public function deleted(Reply $reply)
    {
        $reply->post->decrement('reply_count',1);
    }
}