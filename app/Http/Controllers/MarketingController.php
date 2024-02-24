<?php

namespace App\Http\Controllers;
use App\Models\Balance;
use Illuminate\Http\Request;
use App\Models\Marketing; // Enklwi model la

class MarketingController extends Controller
{
    public function store(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'platform' => 'required',
            'service' => 'required',
            'quantity' => 'required|integer',
            'url' => 'required|url',
            'total_price' => 'required|numeric',
        ]);

        // Calculate the total price from the form data
        $totalPrice = $request->total_price;

        // Retrieve the authenticated user's ID
        $userId = auth()->user()->id;

        // Check if the user has enough USD balance to cover the total price
        $balance = Balance::where('user_id', $userId)->first();
        if (!$balance) {
            // Handle the case where the balance is not found
            return redirect()->back()->with('error', 'Balance not found.');
        }

        // Check if the user has enough USD balance
        if ($balance->usd_balance < $totalPrice) {
            // Handle the case where the user doesn't have enough balance
            return redirect('/marketing')->with('error', 'Insufficient balance.');
        }

        // Deduct the total price from the user's USD balance
        $balance->usd_balance -= $totalPrice;
        $balance->save();

        // Create a new marketing order
        $marketing = new Marketing();
        $marketing->user_id = $userId;
        $marketing->platform = $request->platform;
        $marketing->service = $request->service;
        $marketing->quantity = $request->quantity;
        $marketing->url = $request->url;
        $marketing->total_price = $totalPrice;
        $marketing->status = 'pending';
        $marketing->save();

        // Redirect with success message
        return redirect('/marketing')->with('success', 'Order  placed successfully!');
    }

    public function marketingOrders()
    {
        $marketingData = Marketing::paginate(5); // Modify here to paginate with 5 items per page
        // dd($marketingData); // Uncomment this line to check retrieved data
        return view('admin.marketingoders', ['marketingData' => $marketingData]);
    }
    
    

    // public function updateStatus(Request $request, $id)
    // {
    //     $marketing = Marketing::findOrFail($id);
    //     $marketing->status = $request->input('status');
    //     $marketing->save();
    
    //     return redirect('/marketingoders')->with('success', 'Status updated successfully!');

    // }
    
    public function updateStatus(Request $request)
    {
        // Valide done yo, si sa nesesè
        $validatedData = $request->validate([
            'status' => 'required|in:pending,In-Progress,completed',
        ]);

        // Wè si ou ka jwenn yon ekzanp nan Model Marketing ak id ki te pase nan fòm lan
        $marketing = Marketing::find($request->input('marketing_id'));

        // Si ou pa jwenn ekzanp la, ou ka retounen yon erè oswa pran aksyon apwopriye
        if (!$marketing) {
            return redirect()->back()->with('error', 'Marketing order not found.');
        }

        // Mete ajou estati a nan ekzanp la
        $marketing->status = $validatedData['status'];
        $marketing->save();

        // Redireksyone oswa afiche yon mesaj ki di operasyon an reyisi
        return redirect()->back()->with('success', 'Status updated successfully!');
    }
    
    
    public function userMarketingOrders()
    {
        // Jwenn ID itilizatè kounye a
        $userId = auth()->user()->id;
    
        // Rele modèl la pou jwenn lis odè marketing pou itilizatè a ak paginasyon
        $marketingData = Marketing::where('user_id', $userId)->paginate(5);
    
        return view('user.marketingodered', ['marketingData' => $marketingData]);
    }
    
    
    

    
    
    

}
