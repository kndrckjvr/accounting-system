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

    public function current_basic_pay()
    {
        return $this->hasOne(BasicPay::class)->latest();
    }

    public function basic_pay()
    {
        return $this->hasMany(BasicPay::class)->orderBy('created_at', 'DESC');
    }

    public function payrolls()
    {
        return $this->hasMany(Payroll::class);
    }
}
