<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatesDeductionPayrollPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deduction_payroll', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('deduction_id');
            $table->unsignedInteger('payroll_id');
            $table->timestamps();

            $table->index('deduction_id');
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
        Schema::dropIfExists('deduction_payroll');
    }
}
