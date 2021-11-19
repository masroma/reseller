
      @extends('layouts.front')
      @section('title') {{$detail->title}} @endsection
      @section('content')
      <div class="container-fluid">
    <div class="jumbotron jumbotron-fluid">
        <div class="container text-center">
          <h1 class="display-4">Detail Tentang Kami</h1>

        </div>
      </div>

    <div class="container mt-5">
        <div class="shadow-lg p-3 bg-white rounded pb-5">
            <div class="row ">
            <div class="col-md-12 ">
                     <img class="card-img-top" src="{{ url('profile/'.$detail->image) }}" alt="Card image cap">
                     <div class="card-body">
                     <h5 class="color-primary font-weight-bold">
                       {{substr($detail->title,0,30)}}</a>
                       </h5>
                       <p class="card-text">{!!$detail->content!!}</p>
                     </div>
                 </div>


               </div>

        </div>
    </div>
      </div>

      @endsection
