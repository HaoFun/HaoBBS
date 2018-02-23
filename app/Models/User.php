<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Auth;

class User extends Authenticatable
{
    use Notifiable { notify as protected laravelNotify; }

    public function notify($instance)
    {
        //如通知的是該用戶，就不通知了
        if($this->id === Auth::id())
        {
            return;
        }
        //通知數 + 1
        $this->increment('notification_count');
        $this->laravelNotify($instance);
    }

    public function markAsRead()
    {
        //通知數量歸零
        $this->notification_count = 0;
        $this->save();
        $this->unreadNotifications->markAsRead();
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','avatar','introduction'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }
}
