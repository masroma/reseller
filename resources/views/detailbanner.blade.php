
      @extends('layouts.front')
      @section('title') {{$detail->title}} @endsection
      @section('content')
      <div class="container-fluid">


    <div class="container mt-5">
        <div class="shadow-lg p-3 bg-white rounded pb-5">
            <div class="row ">
                 <div class="col-md-12 ">
                     <img class="card-img-top" src="{{ url('photo_banner/'.$detail->banner) }}" alt="{{$detail->slug}}">
                     <div class="card-body">
                       <h5 class="color-primary font-weight-bold">
                         {{$detail->title}}
                       </h5>
                       <p class="card-text">{!!$detail->content!!}</p>
                     </div>
                 </div>


               </div>

        </div>
    </div>
      </div>

      @endsection
