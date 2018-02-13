<?php

namespace App\Observers;

use App\Models\Post;
use Stichoza\GoogleTranslate\TranslateClient;

class PostObserver
{
    public function saving(Post $post)
    {
        $post->body    = clean($post->body,'user_post_body');
        $post->excerpt = make_excerpt($post->body);

        if(!$post->slug)
        {
            $post->slug = str_slug(TranslateClient::translate(null,'en',$post->title));
        }
    }
}