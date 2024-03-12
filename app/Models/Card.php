<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Card extends Model
{
    protected $fillable = [
        'user_id',
        'user_name',
        'user_email',
        'card',
        'amount',
        'card_number',
        'expiration_date',
        'cvv',
        'status',
        'created_at',
        'updated_at',
    ];
    

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
}