<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->index()->comment('文章標題');
            $table->text('body')->comment('文章主體');
            $table->integer('user_id')->unsigned()->index()->comment('隸屬User');
            $table->integer('topic_id')->unsigned()->index()->comment('隸屬Topic');
            $table->integer('reply_count')->unsigned()->default(0)->comment('回覆數');
            $table->integer('view_count')->unsigned()->default(0)->comment('觀看數');
            $table->integer('last_reply_user_id')->unsigned()->default(0)->comment('最後回覆者');
            $table->integer('order')->unsigned()->default(0)->comment('排序');
            $table->text('excerpt')->nullable()->comment('文章摘要');
            $table->string('slug')->nullable()->comment('文章slug');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
