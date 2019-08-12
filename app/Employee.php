<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    //
    protected $guarded = [];

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function basic_pay()
    {
        return $this->hasOne(BasicPay::class);
    }

    public function payrolls()
    {
        return $this->hasMany(Payroll::class);
    }
}
