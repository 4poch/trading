<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NetflixData;
use App\Models\User;
use Illuminate\Support\Facades\Auth; // Ajoute klas Auth nan lètèl 'use'


class NetflixDataController extends Controller
{
    public function showForm()
    {
        return view('admin.netflixoders'); // Change this to match the actual blade file name
    }

    public function sendData(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'userId' => 'required|exists:users,id', // Validation pou verifye ke ID a egziste nan tab "users"
            'netflixLogin' => 'required',
            'netflixPasscode' => 'required',
            'startDate' => 'required|date',
            'endDate' => 'required|date',
            'action' => 'required|in:enable,delete',
        ]);
    
        // Get the authenticated user's ID
        $userId = auth()->id();
    
        // Retrieve the user by the provided ID
        $user = User::find($validatedData['userId']);
    
        // If the user is found, proceed to save NetflixData for that user
        if ($user) {
            // Create a new NetflixData model instance
            $netflixData = new NetflixData();
            $netflixData->userId = $user->id; // Set the 'userId' to the found user's ID
            $netflixData->netflixLogin = $request->input('netflixLogin');
            $netflixData->netflixPasscode = $request->input('netflixPasscode');
            $netflixData->startDate = $request->input('startDate');
            $netflixData->endDate = $request->input('endDate');
            $netflixData->action = $request->input('action');
    
            // Save the NetflixData instance to the database
            $netflixData->save();
    
            // Redirect back to the form page
            return back()->with('success', 'Data submitted successfully for user ID: ' . $user->id);
        } else {
            // If user is not found, handle accordingly (e.g., show an error message)
            return back()->with('error', 'User with ID ' . $validatedData['userId'] . ' not found.');
        }
    }
    
   

    public function newFunctionName() // Chanje non fonksyon an
    {
        $userId = Auth::id(); // Jwenn ID a nan itilizatè kounye a
        $newVariableName = NetflixData::where('userId', $userId)->get();

        return view('user.infosnetflix', compact('newVariableName')); // Pase varyab la nan paj la
    }
        
 
    


    
}
