<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = ['invoice_id', 'amount_paid', 'payment_date', 'payment_method'];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
}

