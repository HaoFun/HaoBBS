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

    public function show(Request $request, Post $post)
    {
        //如$post->slug不為空值 且 $request->slug不符合$post->slug，執行302跳轉
        if(!empty($post->slug) && $post->slug !== $request->slug)
        {
            return redirect()->to($post->link(),302);
        }
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

        return redirect()->to($post->link())->with('message','新增文章成功');
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
        return redirect()->to($post->link())->with('success','更新文章成功');
    }

    public function destroy(Post $post)
    {
        $this->authorize('destroy',$post);
        $post->delete();
        return redirect()->route('posts.index')->with('success','刪除文章成功');
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
