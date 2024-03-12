<?php

namespace App\Http\Controllers;
use App\Models\Card;
use App\Models\Balance;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CardController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|numeric',
            'user_email' => 'required|email',
            'user_name' => 'required|string',
            'card' => 'required|string',
            'amount' => 'required|numeric|min:5|max:1000',
        ]);
    
        // Récupérer le montant de la balance USD de l'utilisateur
        $user_id = $validatedData['user_id'];
        $userBalance = Balance::where('user_id', $user_id)->first();
    
        if (!$userBalance) {
            // Si aucun solde n'est trouvé pour l'utilisateur, renvoyer une erreur
            return redirect()->back()->with('error', 'User balance not found!');
        }
    
        // Vérifier si le solde de l'utilisateur est suffisant pour effectuer la transaction
        if ($userBalance->usd_balance < $validatedData['amount']) {
            return redirect()->back()->with('error', 'Insufficient balance!');
        }
    
        // Déduire le montant de la balance USD de l'utilisateur
        $userBalance->usd_balance -= $validatedData['amount'];
        $userBalance->save();
    
        // Créer une nouvelle carte dans la base de données
        Card::create($validatedData);
    
        return redirect()->back()->with('success', 'Card created successfully!');
    }
    public function index()
    {
        $cardOrders = Card::all();
        return view('admin.cardoders', compact('cardOrders'));
    }
 
    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'card_id' => 'required|numeric',
            'card_number' => 'required|string',
            'expiration_date' => 'required|string',
            'cvv' => 'required|string',
            'status' => 'required|string',
        ]);
    
        // Retrieve the card by its ID
        $card = Card::find($validatedData['card_id']);
    
        if ($card) {
            // Set card number, expiration date, CVV, and status based on the input in the form
            $card->card_number = $validatedData['card_number'];
            $card->expiration_date = $validatedData['expiration_date'];
            $card->cvv = $validatedData['cvv'];
            $card->status = $validatedData['status'];
            $card->save();
            
            return redirect()->back()->with('success', 'Card information updated successfully!');
        } else {
            return redirect()->back()->with('error', 'Card not found!');
        }
    }
    

    public function showAllCards()
    {
        // Get the authenticated user's ID
        $user_id = auth()->user()->id;
    
        // Retrieve cards belonging to the authenticated user
        $cards = Card::with('user')->where('user_id', $user_id)->latest()->paginate(6);
    
        return view('user.cards', compact('cards'));
    }
    


}

