<?php

namespace App\Observers;

use App\Jobs\TranslateSlug;
use App\Models\Post;

class PostObserver
{
    public function saving(Post $post)
    {
        $post->body    = clean($post->body,'user_post_body');
        $post->excerpt = make_excerpt($post->body);
    }

    public function saved(Post $post)
    {
        if(!$post->slug)
        {
            //將翻譯請求推送至隊列
            dispatch(new TranslateSlug($post));
        }
    }
}