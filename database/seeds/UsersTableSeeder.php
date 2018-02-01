<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //times() 生成10筆假數據
        $users = factory(User::class)->times(10)->make();

        //讓隱藏的欄位可見，並將數據集合轉為陣列
        $user_array = $users->makeVisible(['password','remember_token'])->toArray();

        //插入資料庫
        User::insert($user_array);

        //另外處理ID為1的數據
        $user = User::find(1);
        $user->name   = 'Hao';
        $user->email  = 'howhow926@gmail.com';
        $user->avatar = asset('uploads/images/avatars/201801/31/1_1517402536_hwPQvKK94u.jpg');
        $user->save();
    }
}
