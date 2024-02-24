<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Nps;
use App\Models\User;
use Illuminate\Http\Request;

class NpsController extends Controller
{
    // Metòd pou prezante fòm nan
    public function showNetflixOrderForm()
    {
        return view('admin.netflixOrder'); // Chwazi non paj la kote fòm nan ye
    }

    // Metòd pou anrejistre done yo
    public function postNetflixOrder(Request $request)
    {
        // Valide done yo avan yo jwenn sauv pou asire yo kòrèk
        $validatedData = $request->validate([
            'netflixuser' => 'required',
            'netflix_email' => 'required|email',
            'netflixpass' => 'required',
        ]);

        // Kreye yon nouvo antite "Nps" ak done yo
        $nps = new Nps();
        $nps->netflix_username = $request->input('netflixuser');
        $nps->netflix_email = $request->input('netflix_email');
        $nps->netflix_password = $request->input('netflixpass');
        $nps->save();

        // Redireksyone ou nan menm paj oswa afiche yon mesaj de siksè
        // Anseye yon mesaj nan sesyon pou endike siksè
        $request->session()->flash('success', 'Done yo kreye avèk siksè');

        // Redireksyone ou nan menm paj
        return redirect()->back();
    }


  
    


}
