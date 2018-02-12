<?php

namespace App\Http\Controllers;

use App\Handlers\ImageUploadHandler;
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

    public function show(Post $post)
    {
        return view('posts.show',compact('post'));
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
        $this->authorize('update',$post);
        $topics = Topic::all();
        return view('posts.create_and_edit',compact('post','topics'));
    }

    public function update(PostRequest $request, Post $post)
    {
        $this->authorize('update',$post);
        $post->update($request->all());
        return redirect()->route('posts.show',$post->id)->with('success','更新文章成功');
    }

    public function destroy()
    {

    }

    public function uploadImage(Request $request, ImageUploadHandler $uploader)
    {
        //初始返回數據
        $data = [
            'success'   => false,
            'msg'       => '上傳失敗',
            'file_path' => ''
        ];

        //判斷是否有上傳文件 (這邊的upload_file是在editor中upload 設定的 fileKey)
        if($file = $request->upload_file)
        {
            //保存圖片
            $result = $uploader->save($request->upload_file,'posts',Auth::id(),1024);
            if($result)
            {
                $data['success']   =  true;
                $data['msg']       =  '上傳成功';
                $data['file_path'] =  $result['path'];
            }
        }
        return $data;
    }
}
