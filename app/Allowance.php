<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Allowance extends Model
{
    protected $guarded = [];

    public function payrolls()
    {
        return $this->belongsToMany(Payroll::class);
    }
}
