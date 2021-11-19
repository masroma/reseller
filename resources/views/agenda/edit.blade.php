@extends('layouts.v1')
@section("title") Edit agenda @endsection
@section('content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">agenda</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{ route('agenda.index') }}">Data agenda</a>
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
                            <form action="{{ route('agenda.update',[$data->id]) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf

                                <div class="form-group">
                                    <label for="nama_kategori">Title</label>
                                    <input type="text" name="title"
                                        class="form-control  @error('title') is-invalid @enderror"
                                        placeholder="Title" value="{{ old('title', $data->title) }}">
                                    @error('title')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="nama_kategori">Tanggal Agenda</label>
                                    <input type="date" name="tanggal"
                                        class="form-control  @error('tanggal') is-invalid @enderror"
                                        placeholder="Tanggal" value="{{ old('tanggal', $data->tanggal) }}">
                                    @error('tanggal')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <img src="{{asset('photo_agenda/'.$data->image)}}" border="0" width="150" class="img-rounded" align="center" /><br/>
                                    <label for="agent">Banner</label>
                                    <input type="file" name="image"
                                        class="form-control  @error('image') is-invalid @enderror"
                                        placeholder="Email" value="{{ old('image',$data->image) }}">
                                    @error('image')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                 <div class="form-group">
                                    <label for="nama_kategori">Status</label>
                                    <select name="status" id="status" class="form-control">
                                       <option value="active" @if (old('status',$data->status) == 'active') selected="selected" @endif>Active</option>
                                       <option value="nonactive" @if (old('status',$data->status) == 'nonactive') selected="selected" @endif>Non Active</option>
                                    </select>
                                    @error('status')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="agent">Content</label>
                                    <textarea name="content"  id="summernote" class="form-control  @error('content') is-invalid @enderror">
                                        {{ old('content',$data->content) }}
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
