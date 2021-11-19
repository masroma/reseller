<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Collection;
use Illuminate\Pagination\Paginator;

use Illuminate\Pagination\LengthAwarePaginator;


class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function paginate($items, $perPage = 12, $page = null, $options = [])

    {

        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);

        $items = $items instanceof Collection ? $items : Collection::make($items);

        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);

    }

    public function index(Request $request)
    {
        $search = $request->search;
        $totalTransaksi = Transaksi::count();
        $totalPending = Transaksi::where('status','pending')->count();
        $totalLunas = Transaksi::where('status','lunas')->count();
        $totalOmzet = Transaksi::where('status','lunas')->sum('total_belanja');
        $totalLaba = Transaksi::where('status','lunas')->sum('total_laba');
// product
        if($search){
            $apiresponse = Http::get('https://adminoffice.almalikbuku.com/api/products?search='.$search.'');
        }else{
            $apiresponse = Http::get('https://adminoffice.almalikbuku.com/api/products');
        }
        $dataproduct = $apiresponse->collect();
        $array = $dataproduct['products'];
        $data = $this->paginate($array);
        // $data = $dataproduct['products'];
        return view('dashboard.index',compact('totalTransaksi','totalPending','totalLunas','totalOmzet','totalLaba','data'));
    }

    public function data(){
        try{
            $data = Transaksi::with('customer')->get();
            return datatables()->of($data)
            ->addIndexColumn()
            // ->rawColumns(['banner_'])
            ->make(true);
        } catch (Exception $e) {
            DB::commit();
            return response()->json(
                [
                    'status' => false,
                    'message' => $e->getMessage()
                ]
            );
        }
    }

    public function detailTransaksi($id)
    {
        try{
            $transaksi = Transaksi::findOrFail($id);
            $data = TransaksiDetail::where('transaksi_id',$id)->get();
            return view('transaksi.detail',compact('data','transaksi'));

        } catch (Exception $e) {
            DB::commit();
            return response()->json(
                [
                    'status' => false,
                    'message' => $e->getMessage()
                ]
            );
        }
    }


}
