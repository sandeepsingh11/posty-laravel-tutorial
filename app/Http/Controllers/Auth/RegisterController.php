<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function __construct()
    {
        // user must be a guest to view, otherwise redirect
        $this->middleware(['guest']);
    }

    public function index()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'username' => ['required', 'max:255'],
            'email' => 'required|email|max:255',
            'password' => 'required|confirmed' // look for _confirmation
        ]);

        User::create([
            'name' => $request->get('name'),
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // sign in user
        Auth::attempt($request->only('email', 'password'));

        return redirect()->route('dashboard');
    }
}
