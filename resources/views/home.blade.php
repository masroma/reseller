@extends('layouts.front')
  @section('title') Home page @endsection
  @section('content')

  <div class="container mt-5">
    <div class="row">
        <div class="col-lg-12 col-md-12">
          <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                @foreach( $banner as $row )
              <li data-target="#carouselExampleCaptions" data-slide-to="{{ $loop->index }}" class="{{ $loop->first ? 'active' : '' }}"></li>
              @endforeach
            </ol>
            <div class="carousel-inner">
            @foreach( $banner as $row )
                @if($row->type == 'image')
              <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                <img src="{{ url('photo_banner/'.$row->banner) }}" class="d-block w-100" alt="{{$row->slug}}">
                <div class="carousel-caption bg-dark text-white d-none d-md-block py-3" style=" opacity: 0.8;">
                  <a  href="{{route('detailbanner',$row->id)}}"><h5 style="text-decoration: none; color:white ">{{$row->title}}</h5></a>
                  <p>{!! substr($row->content,0,100)!!}</p>
                </div>
              </div>
              @else
              <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                <video width="100%" controls>
                    <source src="{{ url('photo_banner/'.$row->banner) }}" type="video/mp4">
                </video>
              </div>
              @endif

            @endforeach

            </div>
            <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
          </div>
        </div>
      </div>

        <!-- seleamt datang -->
        <div class="row my-5">
            <div class="col-md-12">
              <h4 class="color-primary">{{$profile->title_section_one}}</h4>
              <p><?php echo $profile->description_section_one;?> </p>
            </div>
          </div>


      <!-- categori -->
      <div class="row my-5  text-center my-2" >
        @foreach ($program as $row)
        <div class="col-md-3">
            <img src="{{ url('photo_program/'.$row->logo) }}" class="rounded-circle img-fluid mb-3" alt="{{$row->title}}">
            {{-- {!! substr($row->content,0,100)!!} --}}
            <h5 class="card-title color-primary">{{$row->title}}</h5>
        </div>
        @endforeach
        {{-- <div class="col-md-3 text-center my-2">
            <img src="{{ url('photo_program/'.$row->logo) }}" class="rounded-circle img-fluid mb-3" alt="{{$row->title}}">

                <h5 class="card-title color-primary">{{$row->title}}</h5>

            {{substr($row->content,0,50)}}
          </div> --}}

      </div>




      <div class="row mt-5 mb-5">
        <div class="col-md-12 text-center">
          {{-- <blockquote class="blockquote text-center"> --}}
            <h4 class="color-primary">
              {{$profile->title_section_one}}
            </h4>
            <p><cite>
             {!!$profile->description_section_two!!}.
            </cite> </p>
          {{-- </blockquote> --}}
        </div>
      </div>

      @if($profile->link_video)
      <div class="row my-5">
        <div class="col-md-12">
          <div class="embed-responsive embed-responsive-16by9">
          <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/{{$profile->link_video}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            <!-- <iframe class="embed-responsive-item" src="" allowfullscreen></iframe> -->
          </div>
        </div>
      </div>
      @endif

      <!-- visi  -->
      <div class="row my-5">
        <div class="col-md-6">
          <img src="{{ url('profile/'.$profile->image_visi) }}" class ="img-fluid rounded" alt="">
        </div>
        <div class="col-md-6">
          <h4 class="color-primary">Visi</h4>
          <p>{{$profile->content_visi}} </p>
        </div>
      </div>

      <!-- misi -->
      <div class="row my-5">
        <div class="col-md-6">
          <h4 class="color-primary">MISI</h4>
        <p>
         {!!$profile->content_misi!!}
        </p>
        </div>
        <div class="col-md-6">
          <img src="{{ url('profile/'.$profile->image_misi) }}" class ="img-fluid rounded" alt="">
        </div>

      </div>



      <!-- berita -->
      <div class="row my-5">
       <div class="col-md-12 py-5">
        <h3 class="color-primary text-center">Berita</h3>
       </div>
       @foreach ($berita as $row)
       <div class="col-md-4 my-2">
        <div class="card">
          <img class="card-img-top" src="{{ url('photo_berita/'.$row->image) }}" alt="{{$row->slug}}">
          <div class="card-body">
           <a href="{{ url('/berita/detail/' . $row->slug) }}">
            <h5 class="color-primary font-weight-bold">
                {{$row->title}}
              </h5>
            </a>
            <p class="card-text">{!!substr($row->content,0,80)!!}</p>
          </div>
        </div>
      </div>
       @endforeach

      </div>

      <div class="row">
        <div class="col-md-12 text-center">
          <a href="{{route('berita')}}" class="btn btn-red bg-dark text-white border-0">Selengkapnya</a>
        </div>
      </div>


    {{-- agenda --}}
    @if(!$agenda->isEmpty())
    <div class="row my-5">
        <div class="col-md-12 py-5">
         <h3 class="color-primary text-center">Agenda</h3>
        </div>
        @foreach ($agenda as $row)
        <div class="col-md-4 my-2">
         <div class="card">
           <img class="card-img-top" src="{{ url('photo_agenda/'.$row->image) }}" alt="{{$row->slug}}">
           <div class="card-body">
               <a href="{{route('detailagenda', $row->slug)}}">
                <h5 class="color-primary font-weight-bold">
                    {{$row->title}}
                  </h5>
               </a>

             <p class="card-text">{{Carbon\Carbon::parse($row->tanggal)->isoFormat('dddd, D MMMM Y')}}</p>
           </div>
         </div>
       </div>
        @endforeach
       </div>

       <div class="row">
         <div class="col-md-12 text-center">
           <a href="{{route('agenda')}}" class="btn btn-red bg-dark text-white border-0">Selengkapnya</a>
         </div>
       </div>
     </div>
     @endif




    </div>

</div>





  @endsection


