<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassmatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classmates', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->default('')->comment('姓名');
            $table->string('phone')->default('')->comment('手机号');
            $table->string('sex')->default('')->comment('性别');
            $table->string('type')->default('')->comment('关系类型');
            $table->string('dormitory')->nullable()->comment('宿舍');
            $table->text('remark')->nullable()->comment('备注');
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
        Schema::dropIfExists('classmates');
    }
}
