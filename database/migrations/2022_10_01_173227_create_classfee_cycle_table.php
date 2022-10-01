<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassfeeCycleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classfee_cycle', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamp('date')->comment('发起时间');
            $table->text('reason')->nullable()->comment('收费原因');
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
        Schema::dropIfExists('classfee_cycle');
    }
}
