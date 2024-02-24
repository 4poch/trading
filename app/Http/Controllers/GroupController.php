<?php

namespace App\Http\Controllers;
use App\Models\Group;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    public function store(Request $request)
{
    // Valide done yo
    $request->validate([
        'group_link' => 'required|url', // Valide ke li se yon URL
        'category' => 'required',
        'user_amount' => 'required|numeric', // Valide ke li se yon chif
        'country' => 'required',
    ]);

    // Si done yo valide, ou ka sòti yo nan tab la
    Group::create([
        'group_link' => $request->input('group_link'),
        'category' => $request->input('category'),
        'user_amount' => $request->input('user_amount'),
        'country' => $request->input('country'),
    ]);

    return redirect()->route('groups.create')->with('success', 'Group WhatsApp ajoute avèk siksè');
}

}
