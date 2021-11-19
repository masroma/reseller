@extends('layouts.front')
@section("title") Detail Product @endsection
@section('content')


<section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
        <div class="row">
            <div class="col-md-5 mb-5">
                <img class="img-fluid w-100" src="{{$data['product']['image']}}" alt="{{$data['product']['slug']}}" />
            </div>
            <div class="col-md-7">
                <h2>{{$data['product']['title']}}</h2>
                <p>Kategori : <b>{{$data['product']['category']['name']}}</b> Berat : <b>{{$data['product']['weight']}} gram</b></p>
                <h3>Rp. {{number_format($data['product']['price'])}}</h3>
                <p>{!!$data['product']['content']!!}</p>

                <div class="row">
                    <div class="col mt-5">
                        <form method="post" enctype="multipart/form-data" action="{{route('tambah-keranjang')}}">
                        @csrf
                        <input type="hidden" name="product_id" value="{{$data['product']['id']}}">
                        <input type="hidden" name="title" value="{{$data['product']['title']}}">
                        <input type="hidden" name="price" value="{{$data['product']['price']}}">
                        <input type="hidden" name="price_reseller" value="{{$data['product']['price_reseller']}}">
                        <input type="hidden" name="image" value="{{$data['product']['image']}}">
                        <input type="hidden" name="weight" value="{{$data['product']['weight']}}">
                        <label for="">QTY</label>
                        <input type="number" class="form-control mb-2" min="1" value="1" name="custom_qty" required>
                        <button href="" class="btn btn-dark btn-block">Beli Sekarang</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>



@endsection

