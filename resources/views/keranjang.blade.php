@extends('layouts.front')
@section("title") Keranjang Belanja @endsection
@section('content')

<header class="bg-dark py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-white">
            <h1 class="display-4 fw-bolder">Keranjang Belanja</h1>
            <p class="lead fw-normal text-white-50 mb-0"></p>
        </div>
    </div>
</header>
<section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive-sm">
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Image</th>
                        <th scope="col">Nama Produk</th>
                        <th scope="col">Qty</th>
                        <th scope="col">Sub Price</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php $total = 0; ?>
                    @foreach ($data as  $index => $row)
                    <?php $total = $total + ($row->price * $row->qty);?>
                    <tr>
                        <th scope="row">{{ $index+1}}</th>
                        <td><img src="{{$row->image}}" width="120px" alt="{{$row->title}}"></td>
                        <td>{{$row->title}}</td>
                        <td>
                            <form class="form-inline flex" action="{{route('update-keranjang')}}" method="post" >
                                @csrf
                                <div class="form-group">
                                    <input type="hidden" name="product_id" value="{{$row->product_id}}">
                                    <input type="number" style="width:60px" value="{{$row->qty}}" name="custom_qty" min="1">
                                    <button class="btn btn-success btn-sm"><i class="fa fa-pencil"></i></button>
                                </div>
                            </form>
                        </td>
                        <td>Rp {{number_format($row->price * $row->qty)}} </td>
                        <td>

                            <a href="{{route('hapus-keranjang',$row->id)}}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                        </td>
                      </tr>
                    @endforeach
                    <tr>
                        <td colspan="4" align="center"><b>Total Belanja</b></td>
                        <td colspan="2" align="center">Rp <b>{{number_format($total)}}</b></td>
                    </tr>
                    <tr>
                        <td colspan="3" align="center"></td>
                        <td colspan="3" align="center">
                            <a href="{{route('home')}}" class="btn btn-warning btn-sm">Lanjut Belanja</a>
                            <a href="{{route('checkout')}}" class="btn btn-success btn-sm">Checkout</a>
                        </td>
                    </tr>
                    </tbody>
                  </table>
                </div>
            </div>
        </div>
    </div>
</section>



@endsection

