@extends('layouts.front')
@section("title") CheckOut @endsection
@section('content')

<header class="bg-dark py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-white">
            <h1 class="display-4 fw-bolder">Checkout</h1>
            <p class="lead fw-normal text-white-50 mb-0"></p>
        </div>
    </div>
</header>
<section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
        <div class="row">
            <div class="col-md-7">
                <h3>Isi Data Pembelian</h3>
                <hr>
                <form action="{{route('proses-transaksi')}}" method="post" >
                    @csrf
                    <div class="form-group mb-2">
                        <label for="">
                            Nama Pembeli
                        </label>
                        <input type="text" class="form-control" name="name">
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-2">
                                <label for="">
                                    No Whatsapp / Hp yang aktif
                                </label>
                                <input type="text" class="form-control" name="kontak">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-2">
                                <label for="">
                                    Email
                                </label>
                                <input type="text" class="form-control" name="email">
                            </div>
                        </div>
                    </div>
                        <?php $totalberat = 0;?>
                        <?php $total = 0; ?>
                        <?php $totalreseller = 0; ?>
                        <?php $totalLaba = 0;?>
                        @foreach ($data as $row)
                         <?php $total = $total + ($row->price * $row->qty);?>
                            <?php $totalberat = $totalberat + ($row->weight * $row->qty);?>

                            <?php $totalreseller = $totalreseller + ($row->price_reseller * $row->qty);?>
                            <?php $totalLaba = $totalLaba + ($total - $totalreseller);?>
                        @endforeach

                    <div class="row">
                        <input type="hidden" value="{{$total}}" class="form-control" name="totalbelanja" id="totalbelanja">
                        <input type="hidden" value="6" class="form-control" name="province_origin">
                        <input type="hidden" value="152" class="form-control" id="city_origin" name="city_origin">
                        <input class="form-control" type="hidden" value="<?php echo $totalberat;?>" id="weight" name="weight">
                        <input type="hidden" class="form-control" id="nama_provinsi" name="nama_provinsi" placeholder="ini untuk menangkap nama provinsi ">
                        <input type="hidden" class="form-control" id="nama_kota" name="nama_kota" placeholder="ini untuk menangkap nama kota">
                        <input type="hidden" name="totalongkir" id="totalongkir" class="form-control" placeholder="ongkir">
                        <input type="hidden" name="totalLaba" id="totallaba" class="form-control" value="{{$totalLaba}}">
                        <input type="hidden" name="service" id="service" class="form-control" placeholder="service">
                    </div>
                    <div class="row">
                        <div class="form-group form-group--inline mb-2">
                            <label for="provinsi">Provinsi</label>
                            <select name="province_id" id="province_id" class="form-control">
                                <option value="">Pilih Provinsi</option>
                                @foreach ($provinsi  as $row)
                                <option value="{{$row['province_id']}}" namaprovinsi="{{$row['province']}}">{{$row['province']}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group mb-2">
                            <label>Kota<span></span></label>
                            <select name="kota_id" id="kota_id" class="form-control">
                                <option value="">Pilih Kota</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group mb-2">
                            <label for="">
                                Alamat Lengkap
                            </label>
                           <textarea name="alamat_lengkap" class="form-control" cols="30" rows="10"></textarea>
                        </div>
                    </div>

                    <hr>
                    <h2>Pilih Layanan Expedisi</h2>

                    <div class="form-group mb-2">
                        <label>Pilih Ekspedisi<span>*</span></label>
                        <select name="kurir" id="kurir" class="form-control">
                            <option value="">Pilih kurir</option>
                            <option value="jne">JNE</option>
                            <option value="tiki">TIKI</option>
                            <option value="pos">POS INDONESIA</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Pilih Layanan<span>*</span></label>
                        <select name="layanan" id="layanan" class="form-control">
                            <option value="">Pilih layanan</option>
                        </select>
                    </div>

                    <button class="btn btn-dark btn-block mt-3">Proses Transaksi</button>
                </form>
            </div>
            <div class="col-md-5">
                <h3>Detail Transaksi</h3>
                <hr>
                <div class="table-responsive-sm">
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama Produk</th>
                            <th scope="col">Qty</th>
                            <th scope="col">Sub Price</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php $total = 0; ?>

                        @foreach ($data as  $index => $row)
                        <?php $total = $total + ($row->price * $row->qty);?>

                        <tr>
                            <th scope="row">{{ $index+1}}</th>

                            <td>{{$row->title}}</td>
                            <td>
                                {{$row->qty}}
                            </td>
                            <td>Rp {{number_format($row->price * $row->qty)}} </td>

                          </tr>
                        @endforeach

                        </tbody>
                      </table>
                    </div>
                <p>Total Belanja : Rp {{number_format($total)}}</p>
                <p>Ongkos Kirim : Rp <span id="ongkoskirim"></span></p>
                <p>Total : Rp <span id="total"></span></p>

            </div>
        </div>
    </div>
</section>

<script>
$(document).ready(function(){
    //ini ketika provinsi tujuan di klik maka akan eksekusi perintah yg kita mau
    //name select nama nya "provinve_id" kalian bisa sesuaikan dengan form select kalian
    $('select[name="province_id"]').on('change', function(){

        var namaprovinsiku = $("#province_id option:selected").attr("namaprovinsi");
        $("#nama_provinsi").val(namaprovinsiku);

        // kita buat variable provincedid untk menampung data id select province
        let provinceid = $(this).val();
        //kita cek jika id di dpatkan maka apa yg akan kita eksekusi
        if(provinceid){
            // jika di temukan id nya kita buat eksekusi ajax GET
            jQuery.ajax({
                // url yg di root yang kita buat tadi
                url:"/kota/"+provinceid,
                // aksion GET, karena kita mau mengambil data
                type:'GET',// type data json
                dataType:'json',// jika data berhasil di dapat maka kita mau apain nih
                success:function(data)
                {
                    console.log(data);
                    $('select[name="kota_id"]').empty();
                    $.each(data, function(key, value){
                        $('select[name="kota_id"]').append('<option value="'+ value.city_id +'" namakota="'+ value.type +' ' +value.city_name+ '">' + value.type + ' ' + value.city_name + '</option>');
                    });
                }
            });
        }else {
            $('select[name="kota_id"]').empty();
        }
    });
    $('select[name="kota_id"]').on('change', function(){
        // membuat variable namakotaku untyk mendapatkan atribut nama kota
        var namakotaku = $("#kota_id option:selected").attr("namakota");
        // menampilkan hasil nama provinsi ke input id nama_provinsi
        $("#nama_kota").val(namakotaku);
    });
});

$('select[name="kurir"]').on('change', function(){
    let origin = $("input[name=city_origin]").val();
    let destination = $("select[name=kota_id]").val();
    let courier = $("select[name=kurir]").val();
    let weight = $("input[name=weight]").val();

    if(courier){
        jQuery.ajax({
            url:"/origin="+origin+"&destination="+destination+"&weight="+weight+"&courier="+courier,
            type:'GET',
            dataType:'json',
            success:function(data){
                console.log(data);
                // $('select[name="layanan"]').empty();

                $.each(data, function(key, value){
                    $.each(value.costs, function(key1, value1){
                        $.each(value1.cost, function(key2, value2){
                            $('select[name="layanan"]').append('<option value="'+ key +'" harga_ongkir="'+value2.value+'" service="'+value1.service+'">' + value1.service + '-' + value1.description + '-' +value2.value+ '</option>');
                        });
                    });
                });
            }
        });
    } else {
        $('select[name="layanan"]').empty();
    }
});

$('select[name="layanan"]').on('change', function(){
        let totalbelanja = $("input[name=totalbelanja]").val();
        // membuat variable namakotaku untyk mendapatkan atribut nama kota
        var harga_ongkir = $("#layanan option:selected").attr("harga_ongkir");
        var service = $("#layanan option:selected").attr("service");
        // menampilkan hasil nama provinsi ke input id nama_provinsi
        $("#ongkoskirim").append(harga_ongkir);
        $("#service").val(service);

        var total_ongkir = $("#layanan option:selected").attr("harga_ongkir");
        $("#totalongkir").val(total_ongkir);

        let total = parseInt(totalbelanja) + parseInt(harga_ongkir);
        $("#total").append(total);
    });



</script>



@endsection

