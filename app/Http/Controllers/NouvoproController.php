<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Balance;
use Illuminate\Http\Request;
use App\Models\Nouvopro; // Ou bezwen enstale modèl la pou kapab itilize li

class NouvoproController extends Controller
{
    public function storeData(Request $request)
    {
        // Valide done yo
        $validatedData = $request->validate([
            'service' => 'required',
            'website_link' => 'required|url',
            'websiteInfo' => 'required',
            'quantity' => 'required|numeric',
            'estimateValue' => 'required',
            'orderDescription' => 'required',
            'policyAccepted' => 'accepted',
        ]);
    
        // Jwenn ID itilizatè a
        $userId = $request->user()->id;
    
        // Kreye yon nouvo instans nan modèl la ak done ki vini nan fòm nan
        $nouvopro = new Nouvopro();
        $nouvopro->user_id = $userId;
        $nouvopro->service = $validatedData['service'];
        $nouvopro->website_link = $validatedData['website_link'];
        $nouvopro->website_info = $validatedData['websiteInfo'];
        $nouvopro->quantity = $validatedData['quantity'];
        $nouvopro->estimate_value = $validatedData['estimateValue'];
        $nouvopro->order_description = $validatedData['orderDescription'];
        $nouvopro->policy_accepted = isset($validatedData['policyAccepted']);
    
        // Anrejistre done yo nan database a
        $nouvopro->save();
    
        // Debite montan ki nan estimateValue a sou balans dola itilizatè a
        $balance = Balance::where('user_id', $userId)->firstOrFail(); // Jwenn balans itilizatè a
    
        $debitAmount = $validatedData['estimateValue']; // Montan pou debite
    
        if ($balance->usd_balance < $debitAmount) {
            // Si balans la pa ase, afiche yon mesaj ere
            return redirect()->back()->with('error', 'Insufficient balance to complete the transaction.');
        }
    
        // Redui balans dola
        $balance->usd_balance -= $debitAmount;
    
        // Anregistre chanjman yo nan baz done yo
        $balance->save();
    
        // Afiche yon mesaj reyisit si debite ase montan
        return redirect()->back()->with('success', 'Your order has been submitted successfully!');
    }
    

    public function showData()
    {
        // Rekipere done yo nan database
        $nouvopros = Nouvopro::paginate(5);
    
        // Retounen view la ak done yo
        return view('admin.newdigitalsevis', ['nouvopros' => $nouvopros]);
    }
    
    public function updateStatus(Request $request, $id)
{
    $nouvopro = Nouvopro::findOrFail($id);
    $nouvopro->status = $request->input('status');
    $nouvopro->save();

    return redirect('/newdigitalsevis')->with('success', 'Status updated successfully!');

}




public function aficheData()
{
    // Get the currently authenticated user's ID
    $userId = auth()->id();

    // Paginate the results for the current user
    $nouvopros = Nouvopro::where('user_id', $userId)->paginate(6);

    // Return the view with the paginated user-specific data
    return view('user.digitalservicehistory', ['nouvopros' => $nouvopros]);
}



}