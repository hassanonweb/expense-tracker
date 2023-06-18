<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $fillable = [
        'name',
        'amount',
        'category_id',
        'payment_method_id',
        'frequency_option_id',
        'description',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    public function frequencyOption()
    {
        return $this->belongsTo(FrequencyOption::class);
    }
}
