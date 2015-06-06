<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/6/6 0006
 * Time: 上午 10:18
 */

class CreateSmsTable extends \Illuminate\Database\Migrations\Migration {

    public function up()
    {
        Schema::create("sms", function(Blueprint $table) {
            $table->increments("id");
            $table->string("mobile");
            $table->string("code");
            $table->string("template_id");
            $table->boolean("validated")->default(false);
            $table->timestamp("expire_time");
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop("sms");
    }
}