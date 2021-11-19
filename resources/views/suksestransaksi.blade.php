@extends('layouts.front')
@section("title") Sukses Transaksi @endsection
@section('content')

<header class="bg-dark py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-white">
            <h1 class="display-4 fw-bolder">Sukses Transaksi</h1>
            <p class="lead fw-normal text-white-50 mb-0"></p>
        </div>
    </div>
</header>
<section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
        <div class="row">
            <div class="col-md-12 text-center py-5">
                <h1>Selamat! Transaksi Anda Berhasil</h1>
                <p>Silahkan cek email kamu dan lakukan pembayaran sesuai petunjuk yang tertera di email</p>
                <a href="{{route('home')}}" class="btn btn-dark mt-3">Kembali ke homepage</a>
            </div>
        </div>
    </div>
</section>



@endsection

