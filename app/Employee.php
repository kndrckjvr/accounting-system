<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    //
    public function branch() {
        $this->hasOne(Branch::class);
    }

    public function allowances() {
        $this->hasMany(Allowance::class);
    }

    public function deductions() {
        $this->hasMany(Deduction::class);
    }
}
