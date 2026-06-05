<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset view.
     */
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    /**
     * Handle an incoming username check and redirect.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'username' => ['required', 'string', 'exists:users,username'],
        ], [
            'username.exists' => 'We cannot find an account with that username.',
        ]);

        return redirect('/reset-password/' . $request->username);
    }

    public function updatePassword(Request $request) 
    {
        $request->validate([
            'username' => 'required|exists:users,username',
            'password' => 'required|string|min:8|confirmed', 
        ], [
            'password.min' => 'The password must be at least 8 characters long.',
            'password.confirmed' => 'The passwords do not match.'
        ]);

        $user = User::where('username', $request->username)->firstOrFail();

        $user->password = Hash::make($request->password);
        $user->save();

        return redirect('/login')->with('status', 'Password successfully updated!');
    }
}