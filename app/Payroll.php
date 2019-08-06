<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{
    //
    public function employee()
    {
        $this->hasMany(Employee::class);
    }
}
