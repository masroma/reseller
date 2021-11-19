@extends('layouts.front')
@section('title') Agenda @endsection
@section('content')
<div class="container-fluid">
    <div class="jumbotron jumbotron-fluid">
        <div class="container text-center">
          <h1 class="display-4">Agenda</h1>
          <p class="lead">Agenda {{$profile->title_section_one}}</p>
        </div>
      </div>

    <div class="container mt-5">
        <div class="shadow-lg p-3 bg-white rounded pb-5">
            <div class="row my-5">
                @foreach($berita as $row)
                 <div class="col-md-4 my-2">
                   <div class="card">
                     <img class="card-img-top" src="{{ url('photo_agenda/'.$row->image) }}" alt="{{$row->slug}}">
                     <div class="card-body">
                       <h5 class="color-primary font-weight-bold">
                         <a href="{{ url('/agenda/detail/' . $row->slug) }}" class="color-primary font-weight-bold">{{substr($row->title,0,30)}}</a>
                       </h5>
                       <p class="card-text">{{Carbon\Carbon::parse($row->tanggal)->isoFormat('dddd, D MMMM Y')}}</p>
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
