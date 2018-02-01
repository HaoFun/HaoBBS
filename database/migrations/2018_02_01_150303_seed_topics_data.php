<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeedTopicsData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $topics = [
            [
                'name'        => '籃球',
                'description' => '這是籃球描述'
            ],
            [
                'name'        => '足球',
                'description' => '這是足球描述'
            ],
            [
                'name'        => '棒球',
                'description' => '這是棒球描述'
            ],
            [
                'name'        => '網球',
                'description' => '這是網球描述'
            ]
        ];
        DB::table('topics')->insert($topics);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //truncate() 清空數據
        DB::table('topics')->truncate();
    }
}
