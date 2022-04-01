<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserCollectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_collects', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('resource_id')->default(0)->comment('关联资源id');
            $table->integer('user_id')->default(0)->comment("用户id");
            $table->index('user_id');
            $table->index('resource_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_collects');
    }
}
