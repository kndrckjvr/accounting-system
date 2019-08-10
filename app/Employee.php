<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    //
    protected $guarded = [];

    public function branch() {
        return $this->belongsTo(Branch::class);
    }

    public function allowances() {
        return $this->hasMany(Allowance::class);
    }

    public function deductions() {
        return $this->hasMany(Deduction::class);
    }
}
