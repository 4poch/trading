<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nouvopro extends Model
{
    use HasFactory;

    protected $fillable = [
        'service',
        'website_link',
        'website_info',
        'quantity',
        'estimate_value',
        'order_description',
        'policy_accepted',
    ];

    // Nouvopro.php (Model)
public function user()
{
    return $this->belongsTo(User::class);
}

}