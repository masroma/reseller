<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Cart;
use App\Models\Infobanner;
use App\Models\Program;
use App\Models\TentangKami;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $totalCart = Cart::where('ip_address','=',$request->ip())->count();
        $banner = Infobanner::limit(5)->orderBy('id','DESC')->get();
        $profile = TentangKami::latest()->first();
        $tentangkamis = TentangKami::all();
    //    dd($tentangkamis);
        $program = Program::limit(4)->orderBy('id','ASC')->get();
        $berita = Berita::where('type','=','berita')->limit(3)->orderBy('id','DESC')->get();
        $agenda = Berita::where('type','=','agenda')->limit(3)->orderBy('id','DESC')->get();
        return view('home', compact('banner','program','profile','berita','agenda','tentangkamis','totalCart'));
    }

    public function detail(Request $request,$id)
    {
        $totalCart = Cart::where('ip_address','=',$request->ip())->count();
        $tentangkamis = TentangKami::all();
        $profile = TentangKami::latest()->first();
        $program = Program::limit(4)->orderBy('id','ASC')->get();
        $detail = Program::where('id',$id)->first();

        if($detail == null){
            return redirect()->route('home');
        }else{
            return view('detailprogram',compact('profile','program','detail','tentangkamis','totalCart'));
        }

    }

    public function detailBanner(Request $request, $id)
    {
        $totalCart = Cart::where('ip_address','=',$request->ip())->count();
        $tentangkamis = TentangKami::all();
        $profile = TentangKami::latest()->first();
        $program = Program::limit(4)->orderBy('id','ASC')->get();
        $detail = Infobanner::where('id',$id)->first();
        if($detail == null){
            return redirect()->route('home');
        }else{
            return view('detailbanner',compact('profile','program','detail','tentangkamis','totalCart'));
        }

    }
}
