@extends('layouts.v1')
@section('title') Dashboard @endsection
@section('content')
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Dashboad</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            {{-- <li class="breadcrumb-item active">Starter Page</li> --}}
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
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <p>Selamat datang {{Auth::user()->name}}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">
                        <h5>Total Transaksi</h5>
                    </div>
                    <div class="card-body">
                        <h2>{{$totalTransaksi}}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">
                        <h5>Total Transaksi Pending</h5>
                    </div>
                    <div class="card-body">
                        <h2>{{$totalPending}}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">
                        <h5>Total Transaksi Lunas</h5>
                    </div>
                    <div class="card-body">
                        <h2>{{$totalLunas}}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">
                        <h5>Total Omzet</h5>
                    </div>
                    <div class="card-body">
                        <h2>Rp {{number_format($totalOmzet)}}</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <h2>Transaksi</h2>
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <table id="table" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>No Invoice</th>
                                    <th>Customer</th>
                                    <th>Total Belanja</th>
                                    <th>Total Ongkir</th>
                                    <th>Status</th>
                                    <th>Kurir</th>
                                    <th>Layanan</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content -->

@stop
@section('script')
<script>



    // ini vendor data
    (function() {
            loadDataTable();
        })();

        function loadDataTable() {
            $(document).ready(function () {
                $('#table').DataTable({
                    "scrollX": true,
                    "autoWidth": true,
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: "{{ route('dashboard.data') }}",
                        type: "GET",
                    },
                    columns: [
                    {
                        data:"DT_RowIndex",
                        name:"DT_RowIndex"
                    },

                        {
                            data: 'no_invoice',
                            name: 'no_invoice'
                        },

                        {
                            data: 'customer.nama',
                            name: 'customer.nama'
                        },

                        {
                            data: 'total_belanja',
                            name: 'total_belanja'
                        },

                        {
                            data: 'total_ongkir',
                            name: 'total_ongkir'
                        },

                        {
                            data: 'status',
                            name: 'status'
                        },

                        {
                            data:'kurir',
                            name:'kurir'
                        },

                        {
                            data:'layanan',
                            name:'layanan'
                        },


                        {
                                    data: 'id',
                                    name: 'id',
                                    render: function(value, param, data) {
                                        return '<div class="btn-group">' +
                                            '<a class="btn btn-sm btn-primary" href="/admin/transaksi/detail/' + value +
                                    '"><i class="fas fa-eye"></i></a> ';
                                    }
                                }

                    ],
                    order: [
                        [0, 'asc']
                    ]
                });
            });
        }


  </script>
  @endsection


