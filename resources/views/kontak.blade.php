@extends('layouts.front')
@section('title') Kontak @endsection
@section('content')

<div class="container-fluid mt-5">
<div class="jumbotron jumbotron-fluid">
    <div class="container text-center">
      <h1 class="display-4">Kontak Kami</h1>
    </div>
  </div>

<div class="container mt-5">
    <div class="shadow-lg p-3 bg-white rounded pb-5">
        <div class="row my-5">
            <div class="col-md-8 mb-2">
                {!!$kontak->google_map!!}
            </div>

            <div class="col-md-4">
                <div class="row">
                    <div class="col-md-12">
                        <h4 class="color-primary">
                            Alamat
                        </h4>
                        <p>{{$kontak->alamat}}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <h4 class="color-primary">
                            Kontak
                        </h4>
                        <a href="https://wa.me/{{$profile->kontak}}" class="btn btn-success btn-block">whatsapp</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
