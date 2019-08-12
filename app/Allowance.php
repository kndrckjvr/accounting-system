<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Allowance extends Model
{
    public function payrolls()
    {
        return $this->belongsToMany(Payroll::class);
    }
}
