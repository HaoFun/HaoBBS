<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function update(User $currentUser, User $user)
    {
        //第一個參數為 當前用戶 ， 第二個參數為User Model注入的 $user(這邊也就是url中 users/1/edit <==這裡面的1)
        //所以當用戶的ID 等於 要編輯的ID才能夠正常訪問
        //假設當前用戶沒有登入，這邊會自動返回false
        return $currentUser->id === $user->id;
    }
}
