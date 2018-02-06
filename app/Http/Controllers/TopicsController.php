<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Topic;
use Illuminate\Http\Request;

class TopicsController extends Controller
{
    public function show(Topic $topic)
    {
        //取Topic主題關聯的post文章，預加載user、topic防止N+1問題，並按照每頁20筆來分頁
        $posts = Post::where('topic_id',$topic->id)->with('user','topic')->paginate(20);
        return view('posts.index',compact('posts','topic'));
    }
}
