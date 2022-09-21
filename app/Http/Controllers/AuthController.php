<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

  public function indexLogin()
  {
    return view('pages.login', [
      "title" => "Login"
    ]);
  }

  public function login(Request $request)
  {
    $credentials = $request->validate([
      'email' => 'required|email',
      'password' => 'required'
    ]);


    if (Auth::attempt($credentials)) {
      $request->session()->regenerate();
      if (Auth::user()->level == "admin") {
        return redirect()->intended('/dashboard');
      } else if (Auth::user()->level == "kasir") {
        return redirect()->intended('/kasir');
      } else {
        return redirect()->intended('/');
      }
    }

    return back()->with('loginError', 'Gagal login!!');
  }

  public function logout(Request $request)
  {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerate();
    return redirect('/');
  }
}
