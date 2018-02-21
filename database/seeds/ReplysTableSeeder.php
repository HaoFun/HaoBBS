<?php

use Illuminate\Database\Seeder;

class ReplysTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //將所有User ID取出並轉為陣列格式， [1,2,3,4]
        $user_ids = \App\Models\User::all()->pluck('id')->toArray();

        //將所有Post ID取出並轉為陣列格式
        $post_ids = \App\Models\Post::all()->pluck('id')->toArray();

        //實例化Faker
        $faker = app(Faker\Generator::class);

        $replys = factory(\App\Models\Reply::class)->times(500)
            ->make()->each(function ($reply,$index) use ($user_ids,$post_ids,$faker)
        {
            //隨機將$user_ids中值賦給$reply->user_id
            $reply->user_id = $faker->randomElement($user_ids);

            //文章ID
            $reply->post_id = $faker->randomElement($post_ids);
            \App\Models\Post::find($reply->post_id)->increment('reply_count');
        });
        \App\Models\Reply::insert($replys->toArray());
    }
}
