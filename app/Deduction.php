<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deduction extends Model
{
    protected $guarded = [];
    
    public function payrolls()
    {
        return $this->belongsToMany(Payroll::class);
    }
}
