<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        return view('home.index');
    }

    public function dashboard()
    {
        $user = Auth::user();

        if (! isset($user)) {
            return redirect('/login');
        }

        return view('dashboard.index');
    }
}
