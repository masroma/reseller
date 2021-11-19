<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Program;
use App\Models\TentangKami;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Collection;
use Illuminate\Pagination\Paginator;

use Illuminate\Pagination\LengthAwarePaginator;

class ProductController extends Controller
{

    public function paginate($items, $perPage = 12, $page = null, $options = [])

    {

        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);

        $items = $items instanceof Collection ? $items : Collection::make($items);

        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);

    }

    public function index(Request $request)
    {
        $category = $request->category;
        $search = $request->search;
        $profile = TentangKami::latest()->first();
        $program = Program::limit(4)->orderBy('id','ASC')->get();
        $totalCart = Cart::where('ip_address','=',$request->ip())->count();
        if($category){
            $apiresponse = Http::get('https://adminoffice.almalikbuku.com/api/category/'.$category.'');
        }else if($search){
            $apiresponse = Http::get('https://adminoffice.almalikbuku.com/api/products?search='.$search.'');
        }else{
            $apiresponse = Http::get('https://adminoffice.almalikbuku.com/api/products');
        }

        $dataasli = $apiresponse->collect();
        // dd($dataasli);
        $tentangkamis = TentangKami::all();
        $array = $dataasli['products'];
        $data = $this->paginate($array);
        $dataCategory = Http::get('https://adminoffice.almalikbuku.com/api/categories');
        $category = $dataCategory->collect();
        return view('product',compact('data','totalCart','program','profile','tentangkamis','category'));
    }


    public function detail(Request $request, $slug)
    {
        $profile = TentangKami::latest()->first();
        $tentangkamis = TentangKami::all();
        $program = Program::limit(4)->orderBy('id','ASC')->get();
        $apiresponse = Http::get('https://adminoffice.almalikbuku.com/api/product/'.$slug);
        $data = $apiresponse->collect();
        $totalCart = Cart::where('ip_address','=',$request->ip())->count();
        return view('detail',compact('data','totalCart','profile','program','tentangkamis'));
    }


}
