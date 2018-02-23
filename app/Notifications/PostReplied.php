<?php

namespace App\Notifications;

use App\Models\Reply;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class PostReplied extends Notification implements ShouldQueue
{
    use Queueable;
    public $reply;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Reply $reply)
    {
        $this->reply = $reply;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database','mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toDatabase($notifiable)
    {
        $post = $this->reply->post;
        $link = $post->link(['#reply'.$this->reply->id]);

        //存入資料庫
        return [
            'reply_id'      => $this->reply->id,
            'reply_content' => $this->reply->content,
            'user_id'       => $this->reply->user->id,
            'user_name'     => $this->reply->user->name,
            'user_avatar'   => $this->reply->user->avatar,
            'post_link'     => $link,
            'post_id'       => $post->id,
            'post_title'    => $post->title
        ];
    }

    public function toMail($notifiable)
    {
        $url = $this->reply->post->link(['#reply'.$this->reply->id]);

        return (new MailMessage)->line('你的文章'.$this->reply->post->title.'有新回覆')
            ->action('查看回覆',$url);
    }
}
