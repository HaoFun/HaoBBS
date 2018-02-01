<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Topic;
use App\Models\Post;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //這邊用到集合 pluck() 將全部User id取出並轉為陣列，如 [1,2,3,4,5]
        $user_ids = User::all()->pluck('id')->toArray();

        //同上
        $topic_id = Topic::all()->pluck('id')->toArray();

        //取Faker 實例化
        $faker = app(Faker\Generator::class);

        //生成100筆假數據
        $posts = factory(Post::class)->times(100)
            ->make()->each(function ($post,$index) use ($user_ids,$topic_id,$faker)
        {
           //用User id隨機取一個並賦值
            $post->user_id  = $faker->randomElement($user_ids);
           //用Topic id隨機取一個並賦值
            $post->topic_id = $faker->randomElement($topic_id);
        });
        //將數據轉為陣列在插入資料庫
        Post::insert($posts->toArray());
    }
}
