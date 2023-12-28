<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TwoFactorAuthController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('front.auth.two-factor-auth', compact('user'));
    }
}
