@extends('layouts.v1')
@section('title') Data User @endsection
@section('content')
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">User</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Dashboard</a></li>
            <li class="breadcrumb-item active">User</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col-md-12">
                <a href="{{route('user.create')}}" class="btn btn-primary">Tambah User</a>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <table id="table" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


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
                        url: "{{ route('user.data') }}",
                        type: "GET",
                    },
                    columns: [
                    {
                        data:"DT_RowIndex",
                        name:"DT_RowIndex"
                    },
                        {
                            data: 'name',
                            name: 'name'
                        },

                        {
                            data: 'email',
                            name: 'email'
                        },


                        {
                                    data: 'id',
                                    name: 'id',
                                    render: function(value, param, data) {
                                        return '<div class="btn-group">' +
                                            '<a class="btn btn-sm btn-primary" href="/admin/user/' + value +
                                            '/edit"><i class="fas fa-edit"></i></a> ' +

                                            '<button class="btn btn-sm btn-danger" type="button" onClick="deleteConfirm(' +
                                            value + ')"><i class="fas fa-trash"></i></button>' +
                                            '</div> ';
                                    }
                                }

                    ],
                    order: [
                        [0, 'asc']
                    ]
                });
            });
        }

   function deleteConfirm(id) {
            swal({
                    title: "Kamu Yakin ?",
                    text: "akan menghapus user ini !",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((dt) => {
                    if (dt) {
                        window.location.href = "{{ url('admin/user') }}/" + id + "/delete";
                    }
                });
        }
  </script>
  @endsection
