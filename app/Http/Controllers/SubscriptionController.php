<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Subscription;
use App\Models\User;
class SubscriptionController extends Controller
{
    // Metòd la pou afiche fòm abònman
    public function showSubscriptionForm()
    {
        return view('subscription.form');
    }

    // Metòd la pou resevwa ak tretman fòm soumi
    public function submitSubscription(Request $request)
    {
        // Verifye si itilizatè a se sezon an
        if (Auth::check()) {
            // Valide done yo
            $request->validate([
                'subscription' => 'required|in:Gold,Premium,Vip',
            ]);

            // Si validate a pase, fè operasyon abònman ou yo isit la
            $subscription = new Subscription();
            $subscription->user_id = Auth::user()->id; // ID de l'utilisateur actuel
            $subscription->subscription_type = $request->subscription;
            $subscription->save();

            // Jwenn non itilizatè a nan abònman a
            $userName = Auth::user()->name;

            // Retounen menm paj la ak yon mesaj pou konfime abònman an ak non itilizatè a
            return back()->with('success', 'Abònman an fèt avèk siksè. Itilizatè: ' . $userName);
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



    

}
