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
            $table->bigIncrements('id');
            $table->string('post_name',255)->comment('文章名稱');
            $table->text('post_content')->comment('文章內容');
            $table->integer('post_user_id')->comment('文章發文人');
            //設定 創建文章時   自動帶入 當時時間 CURRENT_TIMESTAMP
            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'))->comment('創建時間');
            //設定 當更新文章時 自動帶入  當時時間 CURRENT_TIMESTAMP
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'))->comment('文章更新時間');
        });
        //對表註解
        \DB::statement("ALTER TABLE `posts` comment '文章'");


        Schema::create('repost',function (Blueprint $table){
            $table->bigIncrements('id');
            $table->bigInteger('post_id');
            $table->string('repost_name');
            $table->text('repost_content');
            $table->bigInteger('repost_user_id');
            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
        });
        \DB::statement("ALTER TABLE 'repost' comment '回覆文章'");

        Schema::create('api_covid_19',function (Blueprint $table){
            $table->bigIncrements('id');
            $table->date('date')->nullable();
            $table->bigInteger('curdate_diagnose')->comment('當日確診');
            $table->bigInteger('total_diagnose')->comment('總確診');
            $table->string('local')->comment('地區');
            $table->string('country')->comment('國家');
            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));

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
