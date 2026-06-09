<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        
        $actie = $request->query('actie', 'overzicht');
        
        $berichten = [];
        $medewerkers = [];
        $gekozenOntvanger = null;
        $bekijkBericht = null;

        if ($actie === 'overzicht') {
            $berichten = Message::where('sender_id', $user->id)
                                ->orWhere('receiver_id', $user->id)
                                ->orderBy('created_at', 'desc')
                                ->get();
                                
        } elseif ($actie === 'nieuw_kies') {
            $medewerkers = User::where(function($q) {
                $q->where('is_admin', true)->orWhere('is_stockmedewerker', true);
            })->where('id', '!=', $user->id)->get();
            
        } elseif ($actie === 'nieuw_formulier') {
            $gekozenOntvanger = User::find($request->query('ontvanger_id'));
            
        } elseif ($actie === 'bekijk') {
            $bekijkBericht = Message::find($request->query('bericht_id'));
        }

        return view('pages.contact', compact('user', 'actie', 'berichten', 'medewerkers', 'gekozenOntvanger', 'bekijkBericht'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'subject'     => 'required|string|max:255',
            'message'     => 'required|string',
            'attachment'  => 'nullable|file|mimes:jpg,png,pdf,docx|max:2048',
        ]);

        $filePath = null;
        if ($request->hasFile('attachment')) {
            $filePath = $request->file('attachment')->store('attachments', 'public');
        }

        Message::create([
            'sender_id'   => Auth::id(),
            'receiver_id' => $request->receiver_id,
            'subject'     => $request->subject,
            'body'        => $request->message,
            'file_path'   => $filePath,
        ]);

        return redirect('/contact')->with('success', 'Formulier is succesvol verstuurd!');
    }
}