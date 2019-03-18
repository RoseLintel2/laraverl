<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBsHounsUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bs_houns_user', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger("user_id")->comment("用户id");
            $table->unsignedInteger("houns_id")->comment("红包id");
            $table->decimal("houns_nums",10,2)->comment("金额");
            $table->enum("fly",['1','2'])->default("1")->comment("是否是运气王 1否2是");
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
        Schema::dropIfExists('bs_houns_user');
    }
}
