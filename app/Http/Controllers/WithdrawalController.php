<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Balance;
use App\Models\Withdrawal;
use App\Models\Deposit;
use App\Models\User;

class WithdrawalController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Valider les données de la requête
        $validatedData = $request->validate([
            'withdraw_amount' => 'required|numeric|min:0.01',
            'currency' => 'required|in:HTG,USD',
            'withdrawal_method' => 'required',
            'recipient_info' => 'required',
        ]);

        $user_id = auth()->user()->id;

        $balance = Balance::where('user_id', $user_id)->first();

        if (!$balance) {
            $balance = new Balance();
            $balance->user_id = $user_id;
            $balance->htg_balance = 0;
            $balance->usd_balance = 0;
            $balance->save();
        }

        $withdraw_amount = $validatedData['withdraw_amount'];
        $currency = $validatedData['currency'];

        if ($currency === 'HTG' && $balance->htg_balance >= $withdraw_amount) {
            $balance->htg_balance -= $withdraw_amount;
        } elseif ($currency === 'USD' && $balance->usd_balance >= $withdraw_amount) {
            $balance->usd_balance -= $withdraw_amount;
        } else {
            return back()->with('error', 'Insufficient balance for withdrawal.');
        }

        $balance->save();

        Withdrawal::create([
            'user_id' => $user_id,
            'amount' => $withdraw_amount,
            'currency' => $currency,
            'withdrawal_method' => $validatedData['withdrawal_method'],
            'recipient_info' => $validatedData['recipient_info'],
            'status' => 'pending',
        ]);

        return back()->with('success', 'Withdrawal successful.');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $withdrawals = Withdrawal::all();
        return view('admin.withdrawrequest', compact('withdrawals'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateStatus(Request $request, $id)
    {
        $withdrawal = Withdrawal::findOrFail($id);
    
        switch ($request->status) {
            case 'approved':
                // Update the withdrawal status to "approved"
                $withdrawal->update(['status' => 'approved']);
                return back();
                break;
            case 'rejected':
                // Check if the withdrawal has already been rejected
                if ($withdrawal->status === 'rejected') {
                    return back()->with('error', 'Withdrawal already rejected.');
                }
    
                try {
                    // Refund the withdrawn amount if status is rejected
                    $amount_refunded = $withdrawal->amount;
    
                    // Find or create the user's balance
                    $user = User::findOrFail($withdrawal->user_id);
                    $balance = Balance::firstOrCreate(['user_id' => $user->id]);
    
                    // Update the balance according to the withdrawal currency
                    if ($withdrawal->currency === 'HTG') {
                        $balance->htg_balance += $amount_refunded;
                    } elseif ($withdrawal->currency === 'USD') {
                        $balance->usd_balance += $amount_refunded;
                    }
    
                    // Save the balance changes
                    $balance->save();
    
                    // Update the withdrawal status to "rejected"
                    $withdrawal->update(['status' => 'rejected']);
                } catch (\Exception $e) {
                    // Handle database errors
                    return back()->with('error', 'Failed to process withdrawal: ' . $e->getMessage());
                }
    
                return back();
                break;
            default:
                break;
        }
    }

    



    public function userWithdrawals()
    {
        $user_id = auth()->user()->id;
        $withdrawals = Withdrawal::where('user_id', $user_id)->latest()->paginate(6);
        
        // Récupérer le solde de l'utilisateur
        $balance = Balance::where('user_id', $user_id)->first();
    
        return view('user.finances', compact('withdrawals', 'balance'));
    }
    
    

    public function userFinances()
    {
        $user_id = auth()->user()->id;
        $userDeposits = Deposit::where('user_id', $user_id)->latest()->paginate(6);
        $userWithdrawals = Withdrawal::where('user_id', $user_id)->latest()->paginate(6);
        $balance = Balance::where('user_id', $user_id)->first();
        return view('user.finances', compact('userDeposits', 'userWithdrawals', 'balance'));
    }
    


    
  


    
}
