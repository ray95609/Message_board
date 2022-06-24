<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReserveTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reserve', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('date')->comment('日期');
            $table->time('time')->comment('時段');
            $table->integer('status')->default(1)->comment('1代表可預約,0代表已被預約');
            $table->string('designer')->comment('設計師');
            $table->bigInteger('user_id')->comment('使用者id');
            $table->bigInteger('update_id')->comment('編輯者');
            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
        });
        \DB::statement("ALTER TABLE `reserve` comment '預約系統'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reserve');
    }
}
