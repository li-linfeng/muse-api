<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChannelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('channels', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name')->default('')->comment('频道名');
            $table->integer('background_image_id')->default(0)->comment('频道背景图id');
            $table->integer('icon_choose_id')->default(0)->comment('频道icon');
            $table->integer('icon_unchoose_id')->default(0)->comment('未选中状态频道icon');
            $table->string('description')->default('')->comment('频道描述');
            $table->tinyInteger('is_show')->default(1)->comment('是否可以使用，默认是1');
            $table->tinyInteger('is_index')->default(0)->comment('是否为首页频道，1代表是，0代表不是');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('channels');
    }
}
