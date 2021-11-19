@extends('layouts.v1')
@section('title') Detail Transaksi @endsection
@section('content')
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Transaksi {{$transaksi->no_invoice}}</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Dashboard</a></li>
            <li class="breadcrumb-item active">Transaksi Detail</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <table id="table" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Image</th>
                                    <th>Product</th>
                                    <th>Harga</th>
                                    <th>Qty</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $index => $row)
                                    <tr>
                                        <td>{{$index++}}</td>
                                        <td><img src="{{$row->image}}" width="40%" alt="{{$row->title}}"></td>
                                        <td>{{$row->title}}</td>
                                        <td>{{number_format($row->price)}}</td>
                                        <td>{{$row->qty}}</td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="3" align="center"><b>Total</b></td>
                                    <td colspan="2" align="center"><b>Rp {{number_format($transaksi->total)}}</b></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


  @endsection
