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
        $bekijkBericht = null;

        if ($actie === 'overzicht') {
            $berichten = Message::where('sender_id', $user->id)
                                ->orWhere('receiver_id', $user->id)
                                ->orderBy('created_at', 'desc')
                                ->get();
                                
        } elseif ($actie === 'bekijk') {
            $bekijkBericht = Message::find($request->query('bericht_id'));
            if ($bekijkBericht && $bekijkBericht->receiver_id === $user->id) {
                $bekijkBericht->is_read = 1;
                $bekijkBericht->save();
            }
        }

        return view('pages.contact', compact('user', 'actie', 'berichten', 'bekijkBericht'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'receiver_role' => 'required|in:admin,stock',
            'subject'     => 'required|string|max:255',
            'message'     => 'required|string',
            'attachment'  => 'nullable|file|mimes:jpg,png,pdf,docx|max:2048',
        ]);

        $filePath = null;
        if ($request->hasFile('attachment')) {
            $filePath = $request->file('attachment')->store('attachments', 'public');
        }

        if ($request->receiver_role === 'admin') {
            $ontvangers = User::where('is_admin', 1)->get();
        } else {
            $ontvangers = User::where('is_stockMedewerker', 1)->get();
        }

        $aantalVerstuurd = 0;

        foreach ($ontvangers as $ontvanger) {
            Message::create([
                'sender_id'   => Auth::id(),
                'receiver_id' => $ontvanger->id,
                'subject'     => $request->subject,
                'body'        => $request->message,
                'file_path'   => $filePath,
            ]);
            
            $aantalVerstuurd++;
        }

        if ($aantalVerstuurd > 0) {
            return redirect('/contact')->with('success', 'Formulier is succesvol verstuurd!');
        } else {
            return redirect()->back()->withErrors(['error' => 'Er konden geen medewerkers gevonden worden in deze groep.']);
        }
    }
}