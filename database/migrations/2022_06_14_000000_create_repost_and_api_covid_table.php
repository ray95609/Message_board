<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRepostAndApiCovidTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('repost',function (Blueprint $table){
            $table->bigIncrements('id');
            $table->bigInteger('post_id');
            $table->string('repost_name');
            $table->text('repost_content');
            $table->bigInteger('repost_user_id');
            $table->integer('status')->default(1);
            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));;
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));;
        });
        \DB::statement("ALTER TABLE `repost` comment '回覆文章'");

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
        \DB::statement("ALTER TABLE `api_covid_19` comment 'covid_19 API 測試'");
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //記得要做 當有人rollback 才會正確刪除
        Schema::dropIfExists('repost');
        Schema::dropIfExists('api_covid_19');
    }
}
