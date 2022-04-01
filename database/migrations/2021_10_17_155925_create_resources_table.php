<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resources', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('cover_image_id')->default(0)->comment('封面图id');
            $table->string('description')->default('')->comment('描述');
            $table->string('title')->default('')->comment('标题');
            $table->integer('play_list_id')->default(0)->comment('所属播放列表id');
            $table->integer('total_time')->default(0)->comment('总播放时长，单位s');
            $table->integer('play_count')->default(0)->comment('总播放数');
            $table->integer('collect_count')->default(0)->comment('总收藏数');
            $table->integer('media_id')->default(0)->comment('真实资源的id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('resources');
    }
}
