<?php
namespace App\Http\Controllers;
use App\Models\Offer;
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

    public function main()
{
    $userId = auth()->id();
    $balance = Balance::where('user_id', $userId)->first();

    if (!$balance) {
        $balance = new Balance();
        $balance->htg_balance = 0.00;
        $balance->usd_balance = 0.00;
    }

    // Kòd pou chèche lis ofri pou itilizatè a
    $offers = Offer::where('user_id', $userId)->paginate(10); // Ou ka modifye 10 si w'ap vle yon lòt kantite ofri pou afiche

    return view('user.dashboard', compact('balance', 'offers'));
}

    
}