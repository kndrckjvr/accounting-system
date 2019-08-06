<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    //
    public function employees() {
        $this->hasMany(Employee::class);
    }
}
