<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatesAllowancePayrollPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('allowance_payroll', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('allowance_id');
            $table->unsignedInteger('payroll_id');
            $table->timestamps();
            
            $table->index('allowance_id');
            $table->index('payroll_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('allowance_payroll');
    }
}
