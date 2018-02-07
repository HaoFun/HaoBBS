<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Topic;
use Illuminate\Http\Request;

class TopicsController extends Controller
{
    public function show(Topic $topic, Request $request, Post $post)
    {
        //取Topic主題關聯的post文章，並按照每頁20筆來分頁
        $posts = $post->withOrder($request->order)->where('topic_id',$topic->id)->paginate(20);
        return view('posts.index',compact('posts','topic'));
    }
}
