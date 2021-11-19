<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        {{-- <meta name="description" content="" />
        <meta name="author" content="" /> --}}

        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="{{asset('front/css/styles.css')}}" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
        <script src="https://code.jquery.com/jquery-3.4.1.js"integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="crossorigin="anonymous"></script>
        {{-- toastr --}}
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

 <!-- createive team -->
   <!-- Google / Search Engine Tags -->
   <meta itemprop="name" content="{{$profile->title_section_one}}">
   <meta itemprop="description" content="{{$profile->description_section_one}}">
   <meta itemprop="image" content="{{asset('front/assets/logo/logo.png')}}">

   <!-- Facebook Meta Tags -->
   <meta property="og:url" content="https://ltqattaqwa.com">
   <meta property="og:type" content="website ltq attaqwa">
   <meta property="og:title" content="{{$profile->title_section_one}}">
   <meta property="og:description" content="{{$profile->description_section_one}}">
   <meta property="og:image" content="{{asset('front/assets/logo/logo.png')}}">

   <!-- Twitter Meta Tags -->
   <meta name="twitter:card" content="ltq Attaqwa">
   <meta name="twitter:title" content="{{$profile->title_section_one}}">
   <meta name="twitter:description" content="{{$profile->description_section_one}}">
   <meta name="twitter:image" content="{{asset('front/assets/logo/logo.png')}}">

  <title>{{$profile->title_section_one}}| @yield('title')</title>
  <style>
      *{
          padding: 0;
          margin: 0;
      }
      .btn-search{
        border:black 1px solid;
        color:black
      }

      .btn-search:hover{
        background-color: black;
        color:white;
      }
  </style>
    </head>
    <body>
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="{{route('home')}}">


          @foreach ($tentangkamis as $page)
          <img src="{{ asset('profile'.'/' .$page->logo) }}" class="img-fluid" width="120" alt="logo">
        @endforeach
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="{{route('product')}}">Product</a></li>
                        {{-- <li class="nav-item"><a class="nav-link" href="#!">About</a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Shop</a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="#!">All Products</a></li>
                                <li><hr class="dropdown-divider" /></li>
                                <li><a class="dropdown-item" href="#!">Popular Items</a></li>
                                <li><a class="dropdown-item" href="#!">New Arrivals</a></li>
                            </ul>
                        </li> --}}
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('tentang-kami')}}">Tentang Kami</a>
                          </li>
                          <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                              data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              Program
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                @foreach ($program as $row)
                                <a class="dropdown-item" href="{{route('detailprogram',$row->id)}}">{{$row->title}}</a>
                                @endforeach
                            </div>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" href="{{route('berita')}}">Berita</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" href="{{route('agenda')}}">Agenda</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" href="{{route('kontak')}}">Kontak</a>
                          </li>
                    </ul>
                    <form class="form-inline my-2 my-lg-0 mr-2" action="{{route('product')}}" method="GET">
                      <input class="form-control mr-sm-2" type="search" placeholder="Pencarian" aria-label="Pencarian" name="search">
                      <button class="btn btn-outline-success btn-search my-2 my-sm-0" type="submit"><i class="fa fa-search"></i></button>
                   </form>

                    <form class="d-flex">

                        <a href="{{route('keranjang-belanja')}}" class="btn btn-outline-dark" >
                            <i class="bi-cart-fill me-1"></i>

                            <span class="badge bg-dark text-white ms-1 rounded-pill">{{$totalCart}}</span>
                        </a>
                    </form>
                </div>
            </div>
        </nav>



        @yield('content')

        <div class="container-fluid mt-5 bg-dark">
            <div class="container">

              <div class="row">
                <div class="col-md-4 py-5">
                  <h5 class="text-white">{{$profile->title_section_one}}</h5>
                  {{-- <p class="text-white">{!!$profile->description_section_one!!}</p> --}}
                </div>
                <div class="col-md-4 py-5">
                  <h5 class="text-white">Program {{$profile->title_section_one}}</h5>
                    <style>
                        .menu-program{
                            color:#ffff;
                        }

                        .menu-program:hover{
                            color:white;
                        }
                        </style>
                  <ul>

                    @foreach($program as $row)
                        <li><a href="{{route('detailprogram',$row->id)}}" class="menu-program">- {{$row->title}}</a></li>
                    @endforeach

                  </ul>
                </div>
                <div class="col-md-4 py-5">
                  <h5 class="text-white">Alamat {{$profile->title_section_one}}</h5>
                  <p class="text-white">{{$profile->alamat}}</p>

                </div>
              </div>
              <div class="row">
                <div class="col-md-12 text-center">
                    <div class="flex mb-3">
                        <a href="{{$profile->facebook}}" class="mr-3"><img src="{{asset('facebook.png')}}" width="50px" alt=""></a>
                        <a href="{{$profile->instagram}}"><img src="{{asset('instagram.png')}}" width="50px" alt=""></a>
                      </div>
                   <p class="text-white">{{$profile->title_section_one}}</p>

                </div>
              </div>
            </div>
        </div>


<a href="https://wa.me/{{$profile->kontak}}" class="act-btn">
    whatsapp kami
  </a>
<style>



.act-btn{
      background:green;
      display: block;
      width: 200px;
      height: 50px;
      line-height: 50px;
      text-align: center;
      color: white;
      font-size: 16px;
      font-weight: bold;
      text-decoration: none;
      transition: ease all 0.3s;
      position: fixed;
      right: 30px;
      bottom:30px;
    }
.act-btn:hover{background: green; color:white;}


</style>


        {{-- <footer class="py-5 bg-dark footer">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; almalikbuku.com 2021</p></div>
        </footer> --}}
        {{-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> --}}
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="{{asset('front/js/scripts.js')}}"></script>

        {{-- toastr --}}
        <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
        <script>
            //message with toastr
            @if(session()-> has('success'))

                toastr.success('{{ session('success') }}', 'BERHASIL!');

            @elseif(session()-> has('error'))

                toastr.error('{{ session('error') }}', 'GAGAL!');

            @endif
          </script>
    </body>

</html>

