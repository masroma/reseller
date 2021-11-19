@extends('layouts.front')
@section('title') Berita @endsection
@section('content')
<div class="container-fluid">
    <div class="jumbotron jumbotron-fluid">
        <div class="container text-center">
          <h1 class="display-4">Berita</h1>
          <p class="lead">Informasi mengenai kegiatan rumah tahfidz</p>
        </div>
      </div>

    <div class="container mt-5">
        <div class="shadow-lg p-3 bg-white rounded pb-5">
            <div class="row my-5">
                @foreach($berita as $row)
                 <div class="col-md-4 my-2">
                   <div class="card">
                     <img class="card-img-top" src="{{ url('photo_berita/'.$row->image) }}" alt="{{$row->slug}}">
                     <div class="card-body">
                     <h5 class="color-primary font-weight-bold">
                         <a href="{{ url('/berita/detail/' . $row->slug) }}" class="color-primary font-weight-bold">{{substr($row->title,0,30)}}</a>
                       </h5>
                       <p class="card-text">{!!substr($row->content,0,120)!!}</p>
                     </div>
                   </div>
                 </div>
                 @endforeach
            </div>
            <div class="row">
                <div class="col-md-12 text-center">
                    {{ $berita->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
