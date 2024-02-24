<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $fillable = [
        'type_Offer',
        'Amount',
        'Cost_value',
        'user_id',
        'policy_agreement',
        'accepted_by_user_id',
        'crypto_address', // Ajoute l'adres crypto nan $fillable
        'completed', // Ajoute kolòn sa nan $fillable
        'completed_by_user_id', // Ajoute kolòn sa nan $fillable
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}