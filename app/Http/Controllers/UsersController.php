<?php
namespace App\Http\Controllers;

use App\Handlers\ImageUploadHandler;
use App\Models\User;
use App\Http\Requests\UserRequest;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth',['except' => ['show']]);
    }

    public function show(User $user)
    {
        return view('users.show',compact('user'));
    }

    public function edit(User $user)
    {
        //驗證授權 第一個參數為UserPolicy中的update()方法，第二個參數為注入的$user
        $this->authorize('update',$user);
        return view('users.edit',compact('user'));
    }

    public function update(UserRequest $request,ImageUploadHandler $uploader, User $user)
    {
        //驗證授權
        $this->authorize('update',$user);
        $data = $request->all();
        if($request->avatar)
        {
            if($result = $uploader->save($request->avatar,'avatars',$user->id,360))
            {
                $data['avatar'] = $result['path'];
            }
        }
        $user->update($data);
        return redirect()->route('users.show',$user->id)->with('success','個人自介更新成功');
    }
}
