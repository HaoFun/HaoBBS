<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use App\Models\Topic;
use Illuminate\Http\Request;
use Auth;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth',['except' => ['index','show']]);
    }

    public function index(Request $request, Post $post)
    {
        $posts = $post->withOrder($request->order)->paginate(20);
        return view('posts.index',compact('posts'));
    }

    public function show()
    {

    }

    public function create(Post $post)
    {
        $topics = Topic::all();
        return view('posts.create_and_edit',compact('post','topics'));
    }

    public function store(PostRequest $request,Post $post)
    {
        $post->fill($request->all());
        $post->user_id = Auth::id();
        $post->save();

        return redirect()->route('posts.show',$post->id)->with('message','新增文章成功!');
    }

    public function edit(Post $post)
    {
        $topics = Topic::all();
        return view('posts.create_and_edit',compact('post','topics'));
    }

    public function update()
    {

    }

    public function destroy()
    {

    }
}
