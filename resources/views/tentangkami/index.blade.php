@extends('layouts.v1')
@section("title") Tentang Kami @endsection
@section('content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Tentang Kami</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{ route('tentangkami.index') }}">Tentang Kami</a>
                        </li>

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
                            <form action="{{ route('tentangkami.update') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf

                                <input type="hidden" name="id" value="{{$data->id}}">
                                <div class="form-group">
                                    <img src="{{asset('profile/'.$data->logo)}}" border="0" width="150" class="img-rounded" align="center" /><br/>
                                    <label for="agent">Logo</label>
                                    <input type="file" name="logo"
                                        class="form-control  @error('logo') is-invalid @enderror"
                                        placeholder="Email" value="{{ old('logo',$data->logo) }}">
                                    @error('logo')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="nama_kategori">Title Section One</label>
                                    <input type="text" name="title_section_one"
                                        class="form-control  @error('title_section_one') is-invalid @enderror"
                                        placeholder="Title Section One" value="{{ old('title_section_one', $data->title_section_one) }}">
                                    @error('title_section_one')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="agent">Description Section One</label>
                                    <textarea name="description_section_one"  id="summernote" class="form-control summernote  @error('content') is-invalid @enderror">
                                        {{ old('description_section_one',$data->description_section_one) }}
                                    </textarea>

                                    @error('description_section_one')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="nama_kategori">Title Section Two</label>
                                    <input type="text" name="title_section_two"
                                        class="form-control   @error('title_section_two') is-invalid @enderror"
                                        placeholder="Title Section Two" value="{{ old('title_section_two', $data->title_section_two) }}">
                                    @error('title_section_one')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="agent">Description Section Two</label>
                                    <textarea name="description_section_two"   class="form-control summernote @error('content') is-invalid @enderror">
                                        {{ old('description_section_two',$data->description_section_two) }}
                                    </textarea>

                                    @error('description_section_two')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="nama_kategori">Link Video</label>
                                    <input type="text" name="link_video"
                                        class="form-control  @error('link_video') is-invalid @enderror"
                                        placeholder="Link Video" value="{{ old('link_video', $data->link_video) }}">
                                    @error('link_video')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <hr>
                                <div class="form-group">
                                    <img src="{{asset('profile/'.$data->image_visi)}}" border="0" width="150" class="img-rounded" align="center" /><br/>
                                    <label for="agent">Image Visi</label>
                                    <input type="file" name="image_visi"
                                        class="form-control  @error('image_visi') is-invalid @enderror"
                                        placeholder="Email" value="{{ old('image_visi',$data->image_visi) }}">
                                    @error('image_visi')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="agent">Content Visi</label>
                                    <textarea name="content_visi"  id="summernote" class="form-control summernote @error('content') is-invalid @enderror">
                                        {{ old('content_visi',$data->content_visi) }}
                                    </textarea>

                                    @error('content_visi')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <img src="{{asset('profile/'.$data->image_misi)}}" border="0" width="150" class="img-rounded" align="center" /><br/>
                                    <label for="agent">Image Misi</label>
                                    <input type="file" name="image_misi"
                                        class="form-control   @error('image_misi') is-invalid @enderror"
                                        placeholder="Email" value="{{ old('image_misi',$data->image_misi) }}">
                                    @error('image_misi')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="agent">Content Misi</label>
                                    <textarea name="content_misi"  id="summernote" class="form-control summernote @error('content') is-invalid @enderror">
                                        {{ old('content_misi',$data->content_misi) }}
                                    </textarea>

                                    @error('content_misi')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="agent">Alamat</label>
                                    <textarea name="alamat"  id="summernote" class="form-control summernote @error('content') is-invalid @enderror">
                                        {{ old('alamat',$data->alamat) }}
                                    </textarea>

                                    @error('alamat')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="agent">Google Map</label>
                                    <textarea name="google_map"  class="form-control summernote  @error('content') is-invalid @enderror">
                                        {{ old('google_map',$data->google_map) }}
                                    </textarea>

                                    @error('google_map')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="nama_kategori">Kontak Whatsapp</label>
                                    <input type="text" name="kontak"
                                        class="form-control  @error('kontak') is-invalid @enderror"
                                        placeholder="Kontak" value="{{ old('kontak', $data->kontak) }}">
                                    @error('kontak')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="nama_kategori">Link Facebook</label>
                                    <input type="text" name="facebook"
                                        class="form-control  @error('facebook') is-invalid @enderror"
                                        placeholder="Link Facebook" value="{{ old('facebook', $data->facebook) }}">
                                    @error('facebook')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="nama_kategori">Link Instagram</label>
                                    <input type="text" name="instagram"
                                        class="form-control  @error('instagram') is-invalid @enderror"
                                        placeholder="Link Instagram" value="{{ old('instagram', $data->instagram) }}">
                                    @error('instagram')
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
