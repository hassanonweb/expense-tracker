<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FrequencyOption extends Model
{
    protected $fillable = ['name'];

    public function expenses()
    {
        return $this->hasMany(Expense::class);
    }
}

