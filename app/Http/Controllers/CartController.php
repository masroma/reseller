<?php

namespace App\Http\Controllers;

use App\Mail\TesEmail;
use App\Models\Cart;
use App\Models\Customer;
use App\Models\Program;
use App\Models\TentangKami;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

class CartController extends Controller
{
    public function index(Request $request)
    {

        $ip = $request->ip();
        $data = Cart::where('ip_address', $ip)->get();
        $totalCart = Cart::where('ip_address','=',$request->ip())->count();
        $profile = TentangKami::latest()->first();
        $tentangkamis = TentangKami::all();
        $program = Program::limit(4)->orderBy('id','ASC')->get();
        return view('keranjang',compact('data','totalCart','profile','tentangkamis','program'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $newqty = $request->custom_qty;
        $ip = $request->ip();
        $cek = Cart::where('product_id', $request->product_id)->where('ip_address','=',$ip)->first();
        if($cek){
            $update = Cart::where('product_id', $request->product_id)
            ->where('ip_address','=',$ip)
            ->update([
                'qty' => $cek->qty + $newqty
            ]);

            if ($update) {
                //redirect dengan pesan sukses
                return Redirect::back()->with(['success' => 'Keranjang Berhasil Ditambah!']);
            } else {
                //redirect dengan pesan error
                return Redirect::back()->with(['error' => 'Keranjang Gagal Ditambah!']);
            }
            // return Redirect::back();
        }else{
            $tambah = new Cart();
            $tambah->product_id = $request->product_id;
            $tambah->title = $request->title;
            $tambah->image = $request->image;
            $tambah->price = $request->price;
            $tambah->price_reseller = $request->price_reseller;
            $tambah->weight = $request->weight;
            $tambah->qty = $newqty;
            $tambah->kode_cart = Str::random(10);
            $tambah->ip_address = $ip;
            $tambah->save();

            if ($tambah) {
                //redirect dengan pesan sukses
                return Redirect::back()->with(['success' => 'Keranjang Berhasil Ditambah!']);
            } else {
                //redirect dengan pesan error
                return Redirect::back()->with(['error' => 'Keranjang Gagal Ditambah!']);
            }
            // return Redirect::back();

        }
    }

    public function update(Request $request)
    {

        $ip = $request->ip();
        $cek = Cart::where('product_id', $request->product_id)->where('ip_address','=',$ip)->first();
        $newqty = $request->custom_qty;
        $update = Cart::where('product_id', $request->product_id)
        ->where('ip_address','=',$ip)
        ->update([
            'qty' => $newqty
        ]);
        if ($update) {
            //redirect dengan pesan sukses
            return Redirect::back()->with(['success' => 'Keranjang Berhasil Diupdate!']);
        } else {
            //redirect dengan pesan error
            return Redirect::back()->with(['error' => 'Keranjang Gagal Diupdate!']);
        }
        // return Redirect::back();
    }

    public function destroy($id)
    {
        $cart = Cart::findOrFail($id);
        $cart->delete();
        return Redirect::back();
    }

    public function get_province()
    {

        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://api.rajaongkir.com/starter/province",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_HTTPHEADER => array(
            "key: 6b9149e8f88a374a2102180d9ea9955b"
          ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        // if ($err) {
        //   echo "cURL Error #:" . $err;
        // } else {
        //   echo $response;
        // }

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            //ini kita decode data nya terlebih dahulu
            $response=json_decode($response,true);
            //ini untuk mengambil data provinsi yang ada di dalam rajaongkir result
            $data_pengirim = $response['rajaongkir']['results'];
            return $data_pengirim;
        }
    }

    public function get_city($id)
    {

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.rajaongkir.com/starter/city?&province=$id",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_HTTPHEADER => array(
            "key: 6b9149e8f88a374a2102180d9ea9955b"
          ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $response=json_decode($response,true);
            $data_kota = $response['rajaongkir']['results'];
            return json_encode($data_kota);
        }
    }

    public function get_ongkir($origin, $destination, $weight, $courier)
    {

        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => "origin=$origin&destination=$destination&weight=$weight&courier=$courier",
          CURLOPT_HTTPHEADER => array(
            "content-type: application/x-www-form-urlencoded",
            "key: 6b9149e8f88a374a2102180d9ea9955b"
          ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $response=json_decode($response,true);
            $data_ongkir = $response['rajaongkir']['results'];
            return json_encode($data_ongkir);
        }

    }

    public function checkout(Request $request)
    {
        $ip = $request->ip();
        $data = Cart::where('ip_address', $ip)->get();
        $provinsi = $this->get_province();
        $totalCart = Cart::where('ip_address','=',$request->ip())->count();
        $profile = TentangKami::latest()->first();
        $tentangkamis = TentangKami::all();
        $program = Program::limit(4)->orderBy('id','ASC')->get();
        return view('checkout', compact('data','totalCart','provinsi','profile','tentangkamis','program'));
    }

    public function prosesTransaksi(Request $request)
    {
        try {
            // dd($request->all());
            $ip = $request->ip();
            $length = 10;
                $random = '';
                for ($i = 0; $i < $length; $i++) {
                    $random .= rand(0, 1) ? rand(0, 9) : chr(rand(ord('a'), ord('z')));
                }

            $no_invoice = 'INV-'.Str::upper($random);

            // save transaksi detail
            //save data customer
            $customer = new Customer();
            $customer->nama = $request->name;
            $customer->kontak = $request->kontak;
            $customer->email = $request->email;
            $customer->provinsi = $request->nama_provinsi;
            $customer->kota = $request->nama_kota;
            $customer->alamat_lengkap = $request->alamat_lengkap;
            $customer->ip_address = $ip;
            $customer->save();

            // // save data transaksi
            $transaksi = new Transaksi();
            $transaksi->no_invoice = $no_invoice;
            $transaksi->customer_id = $customer->id;
            $transaksi->total_belanja = $request->totalbelanja;
            $transaksi->total_ongkir = $request->totalongkir;
            $transaksi->total_laba = $request->totalLaba;
            $transaksi->total = $request->totalbelanja + $request->totalongkir;
            $transaksi->status = 'pending';
            $transaksi->kurir = $request->kurir;
            $transaksi->layanan = $request->service;
            $transaksi->save();

            $cart = Cart::where('ip_address','=',$ip)->get();

            foreach($cart as $row){
                $transaksidetail = new TransaksiDetail();
                $transaksidetail->transaksi_id = $transaksi->id;
                $transaksidetail->product_id = $row->product_id;
                $transaksidetail->title = $row->title;
                $transaksidetail->image = $row->image;
                $transaksidetail->price = $row->price;
                $transaksidetail->laba = $row->price - $row->price_reseller;
                $transaksidetail->qty = $row->qty;
                $transaksidetail->kode_cart = $row->kode_cart;
                $transaksidetail->save();
            }


            // delete cart


            // post to api
            // $cart = Cart::where('ip_address','=',$ip)->get();
            $response = Http::post('https://adminoffice.almalikbuku.com/api/checkouts', [
                "name" => $request->name,
                "kontak" => $request->kontak,
                "email" => $request->email,
                "totalbelanja" => $request->totalbelanja,
                "weight" => $request->weight,
                "nama_provinsi" => $request->nama_provinsi,
                "nama_kota" => $request->nama_kota,
                "totalongkir" => $request->totalongkir,
                "totalLaba" => $request->totalLaba,
                "service" => $request->service,
                "alamat_lengkap" => $request->alamat_lengkap,
                "kurir" => $request->kurir,
                "ip_address" => $ip,
                "transaksi_id" => $transaksi->id,
                "no_invoice" => $transaksi->no_invoice,
                "customer_id" => $customer->id
            ]);

            $data = json_decode($response);
            $cart = Cart::where('ip_address','=',$ip)->get();

            foreach($cart as $row){
                $response = Http::post('https://adminoffice.almalikbuku.com/api/savetransaksidetail', [
                    'transaksi_id' => $transaksi->id,
                    'product_id' => $row->product_id,
                    'title' => $row->title,
                    'image' => $row->image,
                    'price' => $row->price,
                    'price_reseller' => $row->price_reseller,
                    'qty' => $row->qty,
                    'kode_cart' => $row->kode_cart
                ]);
            }

            //tripay funciton


            DB::commit();
            Mail::to($customer->email)->send(new TesEmail($transaksi, $cart, $customer));
            $cart = Cart::where('ip_address','=',$ip)->delete();
            return redirect()->route('sukses-transaksi');

        } catch (Exception $e) {
            //throw $th;
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 422);
        }
    }

    public function suksesTransaksi(Request $request)
    {
        $profile = TentangKami::latest()->first();
        $tentangkamis = TentangKami::all();
        $program = Program::limit(4)->orderBy('id','ASC')->get();
        $totalCart = Cart::where('ip_address','=',$request->ip())->count();
        return view('suksestransaksi',compact('totalCart','profile','program','tentangkamis'));
    }

    public function sendEmail()
    {
        $transaksi = Transaksi::latest()->first();
		Mail::to("masroma75@gmail.com")->send(new TesEmail($transaksi));
		return "Email telah dikirim";
    }
}
