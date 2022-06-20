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
        Schema::create('barber',function (Blueprint $table){
            $table->date('date');
            $table->time('time');
            $table->integer('status')->default(0);
            $table->string('teacher');
            $table->bigInteger('user_id');
            $table->bigInteger('update_id');
            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));;
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));;
        });
        \DB::statement("ALTER TABLE `repost` comment '預約剪髮'");

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
