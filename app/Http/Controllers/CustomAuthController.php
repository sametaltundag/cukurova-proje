<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomAuthController extends Controller
{
    public function giris(Request $req)
    {
        $req->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        if (!$req) {
            return redirect()->route('dashboard')->with('error', 'Zorunlu alanları doldurunuz!');
        }

        $user = User::where('email', $req->email)->first();

        if (!$user) {
            return redirect()->route('dashboard')->with('error', 'Kayıtlı kullanıcı bulunamadı.');
        }

        $credentials = $req->only('email', 'password');

        if (!Auth::attempt($credentials)) {
            return redirect()->route('dashboard')->with('error', 'E-posta ya da şifre hatalı.');
        }

        $req->session()->regenerate();
        $user = Auth::user();

        return redirect()->route('panel.index');
    }
}
