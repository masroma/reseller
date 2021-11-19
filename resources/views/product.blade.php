
     @extends('layouts.front')
     @push('style')
	<style type="text/css">
		.my-active span{
			background-color: #5cb85c !important;
			color: white !important;
			border-color: #5cb85c !important;
		}
	</style>
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
@endpush
     @section("title") Homepage @endsection
     @section('content')
     <!-- Header-->
        <header class="bg-dark py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="text-center text-white">
                    <h1 class="display-4 fw-bolder">Almalik Buku</h1>
                    <p class="lead fw-normal text-white-50 mb-0">Toko buku termurah di Tangerang</p>
                </div>
            </div>
        </header>
        <!-- Section-->
        <section class="py-5">
            <div class="container px-4 px-lg-5 mt-5">
                <div class="row">
                    <div class="col mb-5">
                        <form action="{{route('product')}}" method="GET" class="d-flex">
                            <select name="category" class="form-control mr-2">
                                <option value="">Filter Category</option>
                                @foreach ($category['categories'] as $row)
                                    <option value="{{$row['slug']}}">{{$row['name']}}</option>
                                @endforeach
                            </select>
                            <button class="btn btn-dark">Filter</button>
                        </form>
                    </div>
                </div>
                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                    @foreach ($data as $row)
                    <div class="col mb-5">
                        <div class="card h-100">
                            <!-- Product image-->
                            <img class="card-img-top" src="{{$row['image']}}" alt="..." />
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder">{{$row['title']}}</h5>
                                    <!-- Product price-->
                                    Rp . {{number_format($row['price'])}}
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center">
                                    <a class="btn btn-outline-dark mt-auto" href="{{route('product-detail',$row['slug'])}}">Detail</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="row">
                    <div class="col-md-12" align="center">
                        {{ $data->links('vendor.pagination.custom') }}
                    </div>
                </div>
            </div>
        </section>
        <!-- Footer-->
        @endsection
