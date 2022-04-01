<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserPlayListResourceRelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_play_list_resource_rel', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->default(0);
            $table->integer('resource_id')->default(0);
            $table->integer('play_list_id')->default(0);
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
        Schema::dropIfExists('user_play_list_resource_rel');
    }
}
