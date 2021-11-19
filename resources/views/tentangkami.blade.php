
      @extends('layouts.front')
      @section('title') Tentang Kami @endsection
      @section('content')
      <div class="container-fluid">
    <div class="jumbotron jumbotron-fluid">
        <div class="container text-center">
          <h1 class="display-4">Tentang Kami</h1>

        </div>
      </div>

    <div class="container mt-5">
        <div class="shadow-lg p-3 bg-white rounded pb-5">
            <div class="row ">
                 <div class="col-md-12 ">
                     <img class="card-img-top" src="{{ url('profile/'.$tentangkami->image) }}" alt="Card image cap">
                     <div class="card-body">
                     <h5 class="color-primary font-weight-bold">
                         <a href="{{ url('/tentang-kami/detail/' . $tentangkami->id) }}" class="color-primary font-weight-bold">{{substr($tentangkami->title,0,30)}}</a>
                       </h5>
                       <p class="card-text">{!!$tentangkami->content!!}</p>
                     </div>
                 </div>


               </div>

        </div>
    </div>
      </div>

      @endsection
