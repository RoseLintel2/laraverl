<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJyAdTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jy_ad', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("position_id")->default(0)->comment("广告位id");
            $table->string("ad_name",60)->default("")->comment("广告名称");
            $table->string("image_url",150)->default("")->comment("广告图片地址");
            $table->string("ad_link")->default("")->comment("广告链接地址");
            $table->integer("click_count")->default(6)->comment("广告点击数");
            $table->enum("status",[1,2])->default("1")->comment("广告状态 1开始 2关闭");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jy_ad');
    }
}
