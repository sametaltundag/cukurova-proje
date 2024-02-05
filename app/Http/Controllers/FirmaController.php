<?php

namespace App\Http\Controllers;

use App\Models\Firma;
use App\Models\Teklif;
use Illuminate\Http\Request;

class FirmaController extends Controller
{
    public function firmaara(Request $req){

    $firmaAra = $req->input('searchItem');

    $firma = Firma::where('ad', 'like', '%' . $firmaAra . '%')
                    ->orWhere('email', 'like', '%' . $firmaAra . '%')
                    ->get();

    return response()->json($firma);
    }

    public function firmadetay($id){
        $teklifler = Teklif::get()->count();
        $firmalar = Firma::get()->count();
        $firma = Firma::where('id', $id)->first();
        $count = Teklif::where('firma_id', $id)->count();
        return view('firmadetay', compact('firma', 'count', 'teklifler', 'firmalar'));
    }

    public function firmakaydet(Request $req){

        $firmakontrol = Firma::where('email', $req->email)->first();

        if($firmakontrol){
            return redirect()->route('panel.index')->with('error','Bu email adresi ile daha önce kayıt olunmuştur.');
        } else {
            $firmakayit = Firma::create([
                'ad' => $req->ad,
                'email' => $req->email,
                'numara' => $req->numara
            ]);

            if($firmakayit){
                return redirect()->route('panel.index')->with('success','Firma bilgileri kaydedildi.');
            }
        }
    }
}
