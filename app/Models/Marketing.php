<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marketing extends Model
{
    use HasFactory;
       
    protected $fillable = [
        'platform',
        'service',
        'quantity',
        'quantity',
        'total_price',
        'url',
    ];

    public function user()
{
    return $this->belongsTo(User::class);
}
}
