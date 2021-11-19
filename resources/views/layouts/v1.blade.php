<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title')</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{asset('v1/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Theme style -->
{{-- datatables --}}
  <link rel="stylesheet" href="{{asset('v1/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('v1/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
  <!-- Select2 -->
  <link rel="stylesheet" href="{{asset('v1/plugins/select2/css/select2.min.css')}}">
  <link rel="stylesheet" href="{{asset('v1/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{asset('v1/plugins/summernote/summernote-bs4.min.css')}}">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('v1/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('v1/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('v1/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
  {{-- toastr --}}
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
  <link rel="stylesheet" href="{{asset('v1/dist/css/adminlte.min.css')}}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.min.js"></script>

</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>

    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->


      <!-- Messages Dropdown Menu -->
      <li class="nav-item">
        <a class="nav-link">Hy, {{Auth::user()->name}}</a>
      </li>
      <li class="nav-item">
        <a href="{{route('user.editprofile')}}" class="nav-link">Edit Profile</a>
      </li>
      <li class="nav-item">
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <a href="{{ route('logout') }}" class="nav-link"  onclick="event.preventDefault();
          this.closest('form').submit();">
          <i class="feather icon-power"></i>

      Logout</a>
      </form>
      </li>

    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{asset('v1/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Admin</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        {{-- <div class="image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div> --}}
        <div class="info">
          <a href="#" class="d-block">Hy, {{Auth::user()->name}}</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">


      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

          <li class="nav-item">
            <a href="{{route('dashboard.index')}}" class="nav-link @if(Request::segment(2) == 'dashboard') active @endif">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                {{-- <span class="right badge badge-danger">New</span> --}}
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{route('profile.index')}}" class="nav-link @if(Request::segment(2) == 'profile') active @endif">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Profile Yayasan
                {{-- <span class="right badge badge-danger">New</span> --}}
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{route('program.index')}}" class="nav-link @if(Request::segment(2) == 'program') active @endif">
              <i class="nav-icon fas fa-tasks"></i>
              <p>
                Program Yayasan
                {{-- <span class="right badge badge-danger">New</span> --}}
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{route('banner.index')}}" class="nav-link @if(Request::segment(2) == 'banner') active @endif">
              <i class="nav-icon fas fa-image"></i>
              <p>
                Banner
                {{-- <span class="right badge badge-danger">New</span> --}}
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{route('berita.index')}}" class="nav-link @if(Request::segment(2) == 'berita') active @endif">
              <i class="nav-icon fas fa-newspaper"></i>
              <p>
                Berita
                {{-- <span class="right badge badge-danger">New</span> --}}
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{route('tentangkami.index')}}" class="nav-link @if(Request::segment(2) == 'tentangkami') active @endif">
              <i class="nav-icon fas fa-coffee"></i>
              <p>
                Tentang Kami
                {{-- <span class="right badge badge-danger">New</span> --}}
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{route('agenda.index')}}" class="nav-link @if(Request::segment(2) == 'agenda') active @endif">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Agenda
                {{-- <span class="right badge badge-danger">New</span> --}}
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{route('user.index')}}" class="nav-link @if(Request::segment(2) == 'user') active @endif">
              <i class="nav-icon fas fa-key"></i>
              <p>
                Admin Web
                {{-- <span class="right badge badge-danger">New</span> --}}
              </p>
            </a>
          </li>



        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    @yield('content')
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      Anything you want
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{asset('v1/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('v1/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('v1/plugins/chart.js/Chart.min.js')}}"></script>
<!-- DataTables -->
<script src="{{asset('v1/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('v1/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('v1/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('v1/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>

<script src="{{asset('v1/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('v1/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('v1/plugins/jszip/jszip.min.js')}}"></script>
<script src="{{asset('v1/plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{asset('v1/plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{asset('v1/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('v1/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{asset('v1/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
<!-- Select2 -->
<script src="{{asset('v1/plugins/select2/js/select2.full.min.js')}}"></script>
{{-- toastr --}}
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<!-- AdminLTE App -->
<script src="{{asset('v1/dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('v1/dist/js/demo.js')}}"></script>
<script src="https://cdn.rawgit.com/igorescobar/jQuery-Mask-Plugin/1ef022ab/dist/jquery.mask.min.js"></script>

<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
<!-- Summernote -->
<script src="{{asset('v1/plugins/summernote/summernote-bs4.min.js')}}"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>
<script src="{{asset('v1/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('v1/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('v1/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('v1/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('v1/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('v1/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('v1/plugins/jszip/jszip.min.js')}}"></script>
<script src="{{asset('v1/plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{asset('v1/plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{asset('v1/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('v1/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{asset('v1/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
<script>
  $(function(){
     //Initialize Select2 Elements
     $('.select2').select2()

//Initialize Select2 Elements

// $(function () {
//     // Summernote
//     $('.summernote').summernote()

//     // CodeMirror
//     CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
//       mode: "htmlmixed",
//       theme: "monokai"
//     });
//   });
  $(function () {
    // Summernote
    $('.summernote').summernote()

    // CodeMirror
    CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
      mode: "htmlmixed",
      theme: "monokai"
    });
  })
$('.select2bs4').select2({
  theme: 'bootstrap4'
})
  });

  $(document).ready(function(){
            // Format mata uang.
            $( '.uang' ).mask('0.000.000.000.000.000', {reverse: true});
        })
</script>
<script>
  //message with toastr
  @if(session()-> has('success'))

      toastr.success('{{ session('success') }}', 'BERHASIL!');

  @elseif(session()-> has('error'))

      toastr.error('{{ session('error') }}', 'GAGAL!');

  @endif
</script>
<script>
  $(function () {

    $('#example1').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  });
</script>

@yield('script')
</body>
</html>
