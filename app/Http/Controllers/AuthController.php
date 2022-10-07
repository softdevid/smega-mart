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
      if (Auth::user()->level == "Admin") {
        return redirect()->intended('/dashboard');
      } else if (Auth::user()->level == "Kasir") {
        return redirect()->intended('/kasir');
      } else {
        return redirect()->intended('/');
      }
    }

    return back()->with('loginError', 'Gagal login!!');
  }

  public function indexRegistration()
  {
    return view('pages.registration', [
      "title" => "Registrasi"
    ]);
  }

  public function registration(Request $request)
  {
    $validateData = $request->validate([
      "namaUser" => 'required|max:255',
      "email" => 'required|email',
      "password" => 'required|min:5|max:255',
      "noHp" => 'required|max:13',
      "kabupaten" => 'required|max:255',
      "kecamatan" => 'required',
      "desa" => 'required',
      "alamatLengkap" => 'required|max:255'
    ]);

    $validateData['password'] = Hash::make($validateData['password']);
    $user = User::create($validateData);

    return redirect('/login')->with('success', 'Registrasi Berhasil');
  }

  public function logout(Request $request)
  {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerate();
    return redirect('/');
  }
}
