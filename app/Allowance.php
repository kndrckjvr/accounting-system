<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Allowance extends Model
{
    protected $guarded = [];

    public function payroll()
    {
        return $this->belongsTo(Payroll::class);
    }
    
    public function getTaxFlagAttribute($attribute)
    {
        return $this->taxFlags()[$attribute];
    }

    public function taxFlags()
    {
        return [
            1 => 'Taxable',
            0 => 'Non-Taxable',
        ];
    }
}
