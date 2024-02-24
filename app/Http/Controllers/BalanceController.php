<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Balance;

class BalanceController extends Controller
{
    public function show()
    {
        $userId = auth()->id();
        $balance = Balance::where('user_id', $userId)->first();

        if (!$balance) {
            $balance = new Balance();
            $balance->htg_balance = 0.00;
            $balance->usd_balance = 0.00;
        }

        return view('user.finances', compact('balance'));
    }
}