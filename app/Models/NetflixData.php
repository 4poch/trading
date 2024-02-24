<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// class NetflixData extends Model
// {
//     use HasFactory;

//     protected $fillable = [
//         'user_id',
//         'netflix_login',
//         'netflix_passcode',
//         'start_date',
//         'end_date',
//         'action',
//     ];
// }

class NetflixData extends Model
{
    use HasFactory;
    protected $fillable = ['userId', 'netflixLogin', 'netflixPasscode', 'startDate', 'endDate', 'action'];
}
