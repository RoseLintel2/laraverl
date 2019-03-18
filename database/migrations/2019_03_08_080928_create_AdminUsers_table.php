<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('AdminUsers', function (Blueprint $table) {
            $table->increments('id');
            $table->string("username",30)->comment("用户名");
            $table->string("password",32)->comment("用户密码");
            $table->string("image_url",100)->default("")->comment("用户头像");
            $table->enum("is_super",['1','2'])->default("1")->comment("是否超级管理员 1否 2是");
            $table->enum("status",["1","2"])->default("1")->comment("是否使用 1是 2否");
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
        Schema::dropIfExists('AdminUsers');
    }
}
