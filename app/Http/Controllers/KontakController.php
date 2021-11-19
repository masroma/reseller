<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Profile;
use App\Models\Program;
use App\Models\TentangKami;
use Illuminate\Http\Request;

class KontakController extends Controller
{
    public function index(Request $request)
    {
        $totalCart = Cart::where('ip_address','=',$request->ip())->count();
        $tentangkamis = TentangKami::all();
        $profile = TentangKami::latest()->first();
        $program = Program::limit(4)->orderBy('id','ASC')->get();
        $kontak = TentangKami::latest()->first();
        return view('kontak',compact('profile','program','kontak','tentangkamis','totalCart'));
    }
}
