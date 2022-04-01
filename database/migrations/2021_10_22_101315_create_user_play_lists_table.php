<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserPlayListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_play_lists', function (Blueprint $table) {
            $table->id();
            $table->string('type')->default('')->comment('播放列表的类型，recent,like,custom');;
            $table->integer('user_id')->default(0)->comment('用户id');
            $table->string('name')->default('')->comment('播放列表的名字');
            $table->integer('channel_id')->default(0)->comment('所属频道id');
            $table->timestamps();
            $table->index(['user_id', 'channel_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_play_lists');
    }
}
