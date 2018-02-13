<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title','body','topic_id','excerpt','slug'];

    public function scopeWithOrder($query, $order)
    {
        //不同排序，使用不同的讀取邏輯
        switch($order)
        {
            case 'recent':
                $query = $this->recent();
                break;
            default:
                $query = $this->recentReplied();
                break;
        }
        //預防 N + 1 問題
        return $query->with('user','topic');
    }

    public function scopeRecent($query)
    {
        //以最新發佈排序
        return $query->orderBy('created_at','desc');
    }

    public function scopeRecentReplied($query)
    {
        //以最後回覆排序
        return $query->orderBy('updated_at','desc');
    }

    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function link($params=[])
    {
        //生成posts.show路由，路由中加上slug，$params允許附加的URL參數
        return route('posts.show',array_merge([$this->id,$this->slug],$params));
    }
}
