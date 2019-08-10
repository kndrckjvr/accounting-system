<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $guarded = [];
    //
    public function employees() {
        return $this->hasMany(Employee::class);
    }
}
