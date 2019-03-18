<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminPermissionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('AdminPermission', function (Blueprint $table) {
            $table->increments('id');
            $table->string("name",30)->comment("权限名称");
            $table->integer("fid")->default(0)->comment("父级id");
            $table->string("url",100)->default("")->comment("uri地址");
            $table->enum("is_menu",["1","2"])->default("1")->comment("权限是否显示 1显示 2不显示");
            $table->integer("sort")->comment("排序");
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
        Schema::dropIfExists('AdminPermission');
    }
}
