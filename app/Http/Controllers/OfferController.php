<?php

namespace App\Http\Controllers;
use App\Models\Balance;
use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Asire ou gen linye sa a

class OfferController extends Controller
{
    public function create()
    {
        return view('offers.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'type_Offer' => 'required',
            'Amount' => 'required|numeric',
            'Cost_value' => 'required|numeric',
            'policy_agreement' => 'required',
        ]);

        $offer = Offer::create([
            'type_Offer' => $validatedData['type_Offer'],
            'Amount' => $validatedData['Amount'],
            'Cost_value' => $validatedData['Cost_value'],
            'user_id' => auth()->user()->id,
            'policy_agreement' => isset($validatedData['policy_agreement']),
            // 'accepted' => true, // Set the offer as accepted
            'accepted' => false, // Mete accepted a false lè ou kreye yon ofri

            'accepted_by_user_id' => auth()->user()->id,
        ]);

        return redirect()->route('offers.show', $offer->id)->with('success', 'Offer created successfully!');
    }

    public function show($id)
    {
        $offer = Offer::findOrFail($id); // Récupère l'offre correspondant à l'ID
    
        return redirect()->back()->with('success', 'Offer Created successfully!'); // Passe l'offre à la vue 'offers.show'
    }
    

    public function index()
{
    $offers = Offer::latest()->paginate(8); // Rekiperen tout ofri yo nan baz done

    return view('user.offers', compact('offers'));
}

public function acceptOffer(Request $request, Offer $offer)
{
    // Verifye si itilizatè a pa eseye aksepte ofri l 'pou li menm
    if ($offer->user_id === auth()->user()->id) {
        return redirect()->back()->with('error', 'You cannot accept your own offer.');
    }

    // Verifye si ofri a pa deja aksepte
    if (!$offer->accepted) {
        // Valide done yo
        $request->validate([
            'crypto_address' => 'required',
        ]);

        // Jwenn balans itilizatè a ki ap apwouve ofri a
        $accepterBalance = Balance::where('user_id', auth()->user()->id)->first();

        // Verifye si gen ase kob nan balans itilizatè a ki ap apwouve ofri a
        if ($accepterBalance && $accepterBalance->htg_balance >= $offer->Cost_value) {
            // Debit montan an soti sou balans itilizatè a ki ap apwouve ofri a
            $accepterBalance->htg_balance -= $offer->Cost_value;
            $accepterBalance->save();

            // Mete ofri a nan eta aksepte
            $offer->crypto_address = $request->input('crypto_address');
            $offer->accepted = true;
            $offer->accepted_by_user_id = auth()->user()->id;
            $offer->save();

            // Retounen yon mesaj siksè
            return redirect()->back()->with('success', 'Offer accepted successfully!');
        } else {
            // Retounen yon mesaj ere si balans itilizatè a ki ap apwouve ofri a pa gen ase kob
            return redirect()->back()->with('error', 'Insufficient balance to accept the offer');
        }
    } else {
        // Retounen yon mesaj ere si ofri a deja aksepte
        return redirect()->back()->with('error', 'Offer is already accepted');
    }
}


public function dashboard()
{
    // Rekiperen ofri yo ki asosye ak itilizatè a
    $offers = Offer::where('user_id', auth()->user()->id)->latest()->paginate(6);

    return view('user.dashboard', compact('offers'));
}


public function completeOffer(Request $request, Offer $offer)
    {
        // Verifye si ofri a pa deja konplè
        if (!$offer->completed) {
            // Ajoute l'adres crypto nan ofri a
            $offer->update([
                'completed' => true,
                'completed_by_user_id' => auth()->user()->id,
            ]);

            return response()->json(['success' => 'Offer marked as complete'], 200);
        }

        return response()->json(['error' => 'Offer is already marked as complete'], 400);
    }

    
    public function offersYouAccepted()
{
    try {
        // Log the SQL query
        \DB::listen(function($query) {
            \Log::info($query->sql, $query->bindings);
        });

        // Rekiperen ofri yo ki te aksepte pa itilizatè a
        $acceptedOffers = Offer::where('accepted_by_user_id', auth()->user()->id)
            ->latest()
            ->paginate(8);

        // Log the result
        \Log::info($acceptedOffers);

        return view('user.offeryouaccept', ['acceptedOffers' => $acceptedOffers]);
    } catch (\Exception $e) {
        \Log::error('Error in offersYouAccepted: ' . $e->getMessage());
        return view('error')->with('error', 'An error occurred while retrieving accepted offers data.');
    }
}


public function approveOffer(Offer $offer)
{
    // Verifye si ofri a pa deja apwouve
    if (!$offer->approved) {
        // Verifye si ofri a make as complete
        if (!$offer->completed) {
            // Retounen yon mesaj ere si ofri a pa make as complete
            return redirect()->back()->with('error', 'You can\'t approve this offer until it is marked as complete');
        }

        // Jwenn itilizatè a ki te kreye ofri a
        $offerCreator = $offer->user;

        // Jwenn balans itilizatè a ki te kreye ofri a
        $offerCreatorBalance = Balance::where('user_id', $offerCreator->id)->first();

        // Ajoute montan an sou balans itilizatè a ki te kreye ofri a
        $offerCreatorBalance->htg_balance += $offer->Cost_value;
        $offerCreatorBalance->save();

        // Mete ofri a nan eta apwouve
        $offer->approved = true;
        $offer->approved_by_user_id = auth()->user()->id;
        $offer->save();

        // Retounen yon mesaj siksè
        return redirect()->back()->with('success', 'Offer approved successfully!');
    }

    // Retounen yon mesaj ere si ofri a deja apwouve
    return redirect()->back()->with('error', 'Offer is already approved');
}



}

