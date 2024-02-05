<?php

namespace App\Http\Controllers;

use App\Models\Teklif;
use Illuminate\Http\Request;

class TeklifController extends Controller
{
    public function teklifkaydet(Request $req, $id){

        $satir = [];

        foreach($req->hizmetad as $key => $satir) {
            $created = Teklif::create([
                'hizmetad' => $req->hizmetad[$key],
                'adet' => $req->adet[$key],
                'birimfiyat' => $req->birimfiyat[$key],
                'kdvtip' => $req->kdvtip[$key],
                'iskonto' => $req->iskonto[$key],
                'toplamkdv' => $req->toplamkdv[$key],
                'toplamfiyat' => $req->toplamfiyat[$key],
                'toplamiskonto' => $req->toplamiskonto[$key],
                'firma_id' => $id
            ]);
        }

        if($created){
            return redirect()->route('panel.index')->with('success', 'Teklif oluşturuldu.');
        }
    }
}
