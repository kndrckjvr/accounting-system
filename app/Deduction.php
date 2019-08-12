<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deduction extends Model
{
    public function payrolls() {
        return $this->belongsToMany(Payroll::class);
    }
}
