<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __construct()
    {
        // user must be a guest to view, otherwise redirect
        $this->middleware(['guest']);
    }
    
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // sign in user
        if (!Auth::attempt($request->only('email', 'password'), $request->remember)) {
            return back()->with('status', 'Invalid login details');
        }

        return redirect()->route('dashboard');
    }
}
