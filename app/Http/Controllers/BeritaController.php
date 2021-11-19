<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Cart;
use App\Models\Program;
use App\Models\TentangKami;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    public function index(Request $request)
    {
        $totalCart = Cart::where('ip_address','=',$request->ip())->count();
        $tentangkamis = TentangKami::all();
        $profile = TentangKami::latest()->first();
        $program = Program::limit(4)->orderBy('id','ASC')->get();
        $berita = Berita::where('type','=','berita')->orderBy('id','DESC')->paginate(9);
        return view('berita',compact('profile','program','berita','tentangkamis','totalCart'));
    }

    public function detail(Request $request,$slug)
    {
        $totalCart = Cart::where('ip_address','=',$request->ip())->count();
        $tentangkamis = TentangKami::all();
        $profile = TentangKami::latest()->first();
        $program = Program::limit(4)->orderBy('id','ASC')->get();
        $detail = Berita::where('type','berita')->where('slug','LIKE','%'.$slug.'%')->first();

        return view('detailberita',compact('profile','program','detail','tentangkamis','totalCart'));

    }
}
