<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBasicPaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('basic_pays', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('employee_id');
            $table->float('amount', 8, 2);
            $table->timestamps();

            $table->index('employee_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('basic_pays');
    }
}
