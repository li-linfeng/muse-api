<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlayListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('play_lists', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name')->default('')->comment('播放列表名');
            $table->integer('channel_id')->default(0)->comment('所属频道id');
            $table->integer('total_time')->default(0)->comment('总播放时长，单位s');
            $table->integer('total_play_count')->default(0)->comment('总播放数');
            $table->integer('total_collect_count')->default(0)->comment('总收藏数');
            $table->integer('video_count')->default(0)->comment('关联视频数');
            $table->integer('audio_count')->default(0)->comment('关联音频数');
            $table->integer('is_special')->default(0)->comment('是否为特殊播放列表');
            $table->integer('is_default')->default(0)->comment('是否为默认播放列表');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('play_lists');
    }
}
