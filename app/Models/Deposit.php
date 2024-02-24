<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Deposit extends Model
{
    protected $fillable = [
        'user_id',
        'amount',
        'currency',
        'payment_method',
        'deposit_type',
        'transaction_id',
        'proof_of_payment',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
