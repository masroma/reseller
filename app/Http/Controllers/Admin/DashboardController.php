<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Facades\DB;


class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        $totalTransaksi = Transaksi::count();
        $totalPending = Transaksi::where('status','pending')->count();
        $totalLunas = Transaksi::where('status','lunas')->count();
        $totalOmzet = Transaksi::where('status','lunas')->sum('total_belanja');
        return view('dashboard.index',compact('totalTransaksi','totalPending','totalLunas','totalOmzet'));
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
