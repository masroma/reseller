@extends('layouts.v1')
@section("title") Edit Banner @endsection
@section('content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Banner</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{ route('banner.index') }}">Data Banner</a>
                        </li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('banner.update',[$banner->id]) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf

                                <div class="form-group">
                                    <label for="nama_kategori">Title</label>
                                    <input type="text" name="title"
                                        class="form-control  @error('title') is-invalid @enderror"
                                        placeholder="Title" value="{{ old('title', $banner->title) }}">
                                    @error('title')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <img src="{{asset('photo_banner/'.$banner->banner)}}" border="0" width="150" class="img-rounded" align="center" /><br/>
                                    <label for="agent">Banner</label>
                                    <input type="file" name="banner"
                                        class="form-control  @error('banner') is-invalid @enderror"
                                        placeholder="Email" value="{{ old('banner',$banner->baner) }}">
                                    @error('banner')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="agent">Type Banner</label>
                                        <select name="type" class="custom-select" id="inputGroupSelect01">
                                            <option selected>Choose...</option>
                                            <option value="image" @if (old('type',$banner->type) == 'image') selected="selected" @endif>Gambar</option>
                                            <option value="video" @if (old('type',$banner->type) == 'video') selected="selected" @endif>Video</option>

                                        </select>
                                </div>
                                <div class="form-group">
                                    <label for="agent">Content</label>
                                    <textarea name="content"  id="summernote" class="form-control  @error('content') is-invalid @enderror">
                                        {{ old('content',$banner->content) }}
                                    </textarea>

                                    @error('content')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <button class="btn btn-primary" type="submit">Simpan</button>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /.col-md-6 -->

                <!-- /.col-md-6 -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
@endsection
