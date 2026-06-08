<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    public function index()
    {
        $medewerkers = User::where('is_admin', true)
                           ->orWhere('is_stockmedewerker', true)
                           ->get();
        
        return view('pages.contact', compact('medewerkers'));
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

        return redirect('/contact')->with('success', 'Je bericht is succesvol verstuurd!');
    }
}