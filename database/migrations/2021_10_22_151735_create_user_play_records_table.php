<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserPlayRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_play_records', function (Blueprint $table) {
            $table->id();
            $table->integer('resource_id');
            $table->integer('total_time')->default(0)->comment("播放时长");
            $table->integer('user_id')->default(0)->comment("用户id");
            $table->integer('channel_id')->default(0)->comment("所属频道");
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
        Schema::dropIfExists('user_play_records');
    }
}
