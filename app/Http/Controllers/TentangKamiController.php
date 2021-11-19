<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Profile;
use App\Models\Program;
use App\Models\TentangKami;
use Illuminate\Http\Request;

class TentangKamiController extends Controller
{
    public function index(Request $request)
    {
        $totalCart = Cart::where('ip_address','=',$request->ip())->count();
        $tentangkamis = TentangKami::all();
        $profile = TentangKami::latest()->first();
        $program = Program::limit(4)->orderBy('id','ASC')->get();
        $tentangkami = Profile::latest()->first();
        return view('tentangkami',compact('profile','program','tentangkami','tentangkamis','totalCart'));
    }

    public function detail(Request $request, $id)
    {
        $totalCart = Cart::where('ip_address','=',$request->ip())->count();
        $tentangkamis = TentangKami::all();
        $profile = TentangKami::latest()->first();
        $program = Program::limit(4)->orderBy('id','ASC')->get();
        $detail = Profile::where('id',$id)->first();
        return view('detailtentangkami',compact('profile','program','detail','tentangkamis', 'totalCart'));

    }
}
