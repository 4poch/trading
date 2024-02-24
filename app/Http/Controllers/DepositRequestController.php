<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Deposit;
use App\Models\Balance;

class DepositRequestController extends Controller
{
    public function depositRequests()
    {
        $deposits = Deposit::all();
        return view('admin.depositrequest', ['deposits' => $deposits]);
    }

    public function completeDeposit(Request $request)
{
    $deposit = Deposit::findOrFail($request->deposit_id);

    // Check if the deposit status is pending
    if ($deposit->status === 'pending') {
        // Check if the request is to complete the deposit
        if ($request->status === 'complete') {
            $deposit->status = 'complete';
            $deposit->save();

            // Update user's balance only if the status is complete
            $balance = Balance::firstOrNew(['user_id' => $deposit->user_id]); 
            if ($deposit->currency == 'HTG') {
                $balance->htg_balance += $deposit->amount;
            } else {
                $balance->usd_balance += $deposit->amount;
            }
            $balance->save();

            return redirect()->back()->with('success', 'Deposit status updated successfully.');
        } elseif ($request->status === 'rejected') { // Check if the request is to reject the deposit
            $deposit->status = 'rejected';
            $deposit->save();

            return redirect()->back()->with('success', 'Deposit status updated to rejected.');
        }
    }

    // If the deposit is not in pending status or the request status is not recognized, redirect with an error
    return redirect()->back()->with('error', 'Invalid deposit status or action.');
}

}