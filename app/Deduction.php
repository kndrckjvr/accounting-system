<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deduction extends Model
{
    protected $guarded = [];
    protected $attribute = [
        'types' => [
            0, 1, 2, 3, 4
        ]
    ];
    
    public function payroll()
    {
        return $this->belongsTo(Payroll::class);
    }

    
    public function getTypeAttribute($attribute)
    {
        return $this->getTypes()[$attribute];
    }

    public function getTypes()
    {
        return [
            0 => 'Deduction',
            1 => 'Witholding Tax',
            2 => 'SSS Contribution',
            3 => 'PhilHealth Contribution',
            4 => 'PAG-IBIG Contribution',
            5 => 'GSIS Contribution',
        ];
    }
}