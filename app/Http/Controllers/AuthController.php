<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
      $credentials = $request->validate([
        'email' => 'required|email:dns',
        'password' => 'required'
      ]);

      if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        if (Auth::user()->level === 2) {
          return redirect()->intended('/dashboard');
        }
      }

      return back()->with('loginError', 'Gagal login!!');
    }
}
