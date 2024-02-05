<?php

namespace App\Http\Controllers;

use App\Models\Firma;
use App\Models\Slider;
use App\Models\Teklif;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function dashboard(){
        if(Auth::check()){
            return view('panel');
        }

        return view('welcome');
    }

    public function index(){
        if(Auth::check()){
            $teklifler = Teklif::get()->count();
            $firmalar = Firma::get()->count();
            return view('panel',compact('teklifler','firmalar'));
        }
        else{
            return redirect()->route('dashboard')->with('error', 'Lütfen giriş yapınız.');
        }
    }

    public function slider(){
        $sliderlar = Slider::orderBy('order')->oldest()->get();
        return view('slider',compact('sliderlar'));
    }

    public function slidershow($id){
        $slider = Slider::findOrFail($id);
        return view('slider-detay', compact('slider'));

    }

    public function sliderupdate(Request $req, $id){

        $slider = Slider::findOrFail($id);

        if($req->hasFile('image')){
            if($slider->image && file_exists('slider'.$slider->image)){
                unlink('slider/'.$slider->image);
            }

            $file = $req->file('image');
            $extension = $file->extension();
            $filename = uniqid().'.'.$extension;
            $file->move('slider/', $filename);

            $slider->image = $filename;
        }

        $check=  $slider->update([
            'title' => $req->title,
            'description' => $req->description,
            'order' => $req->order,
            'image' => $slider->image ?? null
        ]);

        return redirect()->route('slidershow', $id)->with(['error' => 'Tebrikler! Slider güncellendi.']);
    }

    public function slidercreate(Request $req){
        if($req->hasFile('image')){

            $file = $req->file('image');
            $extension = $file->extension();
            $filename = uniqid().'.'.$extension;
            $file->move('slider/', $filename);

        }

        $check = Slider::create([
            'title' => $req->title,
            'description' => $req->description,
            'order' => $req->order,
            'image' => $filename ?? null
        ]);

        return redirect()->route('slider.index')->with(['error' => 'Tebrikler! Slider eklendi.']);
    }
}
