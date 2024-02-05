<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomAuthController extends Controller
{
    public function giris(Request $req){
        $req->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        if($req){

            $usercheck = User::where('email', $req->email)->first();

            if ($usercheck) {
                $credentials = $req->only('email', 'password');

                if (Auth::attempt($credentials)) {
                    $req->session()->regenerate();
                    $user = Auth::user();

                    return redirect()->route('panel.index');
                    
                } else {
                    return redirect()->route('dashboard')->with('error', 'E-posta ya da şifre hatalı.');
                }
            } else {
                return redirect()->route('dashboard')->with('error', 'Kayıtlı kullanıcı bulunamadı.');
            }
        }
        else {
            return redirect()->route('dashboard')->with('error', 'Zorunlu alanları doldurunuz!');
        }
    }
}
