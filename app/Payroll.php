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
        return $this->hasMany(Allowance::class);
    }

    public function taxable_allowances()
    {
        return $this->hasMany(Allowance::class)->where('tax_flag', 1);
    }

    public function deductions()
    {
        return $this->hasMany(Deduction::class);
    }
}
