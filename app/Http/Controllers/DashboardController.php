<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        // user must be logged in to view, otherwise redirect
        $this->middleware(['auth']);
    }

    public function index()
    {
        return view('dashboard');
    }
}
