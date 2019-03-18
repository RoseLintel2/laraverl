<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBsHounsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bs_houns', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal("total_houns",10,2)->comment("总金额");
            $table->decimal("left_houns",10,2)->comment("剩余金额");
            $table->unsignedInteger("totla_nums")->comment("红包总个数");
            $table->unsignedInteger("left_nums")->comment("剩余红包个数");
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
        Schema::dropIfExists('bs_houns');
    }
}
