<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{
    protected $guarded = [];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function allowances()
    {
        return $this->belongsToMany(Allowance::class);
    }

    public function taxable_allowances()
    {
        return $this->belongsToMany(Allowance::class)->where('tax_flag', 1);
    }

    public function deductions()
    {
        return $this->belongsToMany(Deduction::class);
    }
}
