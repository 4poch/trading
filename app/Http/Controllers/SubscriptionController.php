<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Subscription;
use App\Models\User;
use App\Models\Balance;

class SubscriptionController extends Controller
{
    // Metòd la pou afiche fòm abònman
    public function showSubscriptionForm()
    {
        return view('subscription.form');
    }

    public function submitSubscription(Request $request)
    {
        // Verifye si itilizatè a se sezon an
        if (Auth::check()) {
            // Valide done yo
            $request->validate([
                'subscription' => 'required|in:Gold,Premium,Vip',
            ]);
    
            // Kalkile pri a pou abònman an
            $amount = $this->getSubscriptionAmount($request->subscription);
    
            // Jwenn balans itilizatè a
            $user = Auth::user();
            $balance = Balance::where('user_id', $user->id)->first();
    
            // Verifye si balans itilizatè a ase pou retire montan abònman an
            if ($balance && $balance->htg_balance >= $amount) {
                // retire montan abònman an soti nan balans itilizatè a
                $balance->htg_balance -= $amount;
                $balance->save();
    
                // fè operasyon abònman ou yo isit la
                $subscription = new Subscription();
                $subscription->user_id = $user->id;
                $subscription->subscription_type = $request->subscription;
                $subscription->amount = $amount;
                $subscription->save();
    
                // Jwenn non itilizatè a
                $userName = $user->name;
    
                // Retounen menm paj la ak yon mesaj pou konfime abònman an ak non itilizatè a
                return back()->with('success', 'Abònman an fèt avèk siksè. Itilizatè: ' . $userName);
            } else {
                // Si balans la pa ase, afiche yon mesaj ere
                $errorMessage = 'Balans ou pa ase pou fè abònman sa a.';
                return back()->with('error', $errorMessage);
            }
        } else {
            // Si itilizatè a pa se sezon an, retounen li nan paj ki gen fòm nan ak yon mesaj erè.
            return back()->with('error', 'Ou pa otorize aksede nan fòm lan.');
        }
    }
    
    // pou afiche subscribtion yo nan admin nan
    public function index()
    {
        $subscriptions = Subscription::paginate(5);
        return view('admin.netflixoders', ['subscriptions' => $subscriptions]);
    }

    public function update(Request $request, $id)
    {
        $subscription = Subscription::find($id);
    
        if (!$subscription) {
            return redirect()->back()->with('error', 'Abònman pa jwenn.');
        }
    
        $newStatus = $request->input('status');
        $subscription->status = $newStatus;
        $subscription->save();
    
        return redirect()->back()->with('success', 'Estati nan abònman an modifye avèk siksè.');
    }




public function indexx()
{
    // Get the currently authenticated user
    $user = Auth::user();

    // Get only the subscriptions for the current user with pagination
    $userSubscriptions = Subscription::with('user')
        ->where('user_id', $user->id)
        ->paginate(10); // You can adjust the number of items per page as needed

    return view('user.netflixplanstatus', ['userSubscriptions' => $userSubscriptions]);
}



    // Fonksyon pou jwenn kantite abònman an
    private function getSubscriptionAmount($subscriptionType)
    {
        switch ($subscriptionType) {
            case 'Gold':
                return 400;
            case 'Premium':
                return 700;
            case 'Vip':
                return 1000;
            default:
                return 0;
        }
    }
    

}
