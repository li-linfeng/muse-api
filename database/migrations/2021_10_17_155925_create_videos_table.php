<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('total_time')->default(0)->comment('总播放时长，单位s');
            $table->string('type')->default('')->comment('资源类型,video,audio');
            $table->string('path')->default('')->comment('资源存放路径');
            $table->string('url')->default('')->comment('资源对外url');
            $table->string('origin_name')->default('')->comment('资源原始文件名');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('videos');
    }
}
