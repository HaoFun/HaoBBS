<?php

namespace App\Observers;


use App\Models\Post;

class PostObserver
{
    public function saving(Post $post)
    {
        $post->excerpt = make_excerpt($post->body);
    }
}