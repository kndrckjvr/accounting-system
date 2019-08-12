<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BasicPay extends Model
{
    protected $guarded = [];

    public function employees()
    {
        return $this->belongsTo(Employee::class);
    }
}
