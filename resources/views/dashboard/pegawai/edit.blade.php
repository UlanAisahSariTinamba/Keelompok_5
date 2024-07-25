@extends('dashboard.layouts.main')
@section('container')


<style>
    form {    
      display: inline;
  } 
  </style>
  
    <h1>Ubah Data Pegawai</h1>
  
  <div class="row mt-2">
    <div class="col-lg-5 ">
      @if ($pegawai->foto)
      <div class="mb-3">
        <img src="{{ url('foto').'/' . $pegawai->foto }}" width="300" class="img img-rounded">
      </div>
    @endif
    </div>
  </div>
  
    <form method="POST" action="{{ url("/dashboard/pegawai/$pegawai->id") }}" enctype="multipart/form-data" class="form-inline mb-2">  
      <input type="hidden" name="nip" value="{{ $pegawai->nip }}"> 
      @method('PATCH')
        @csrf
          <div class="form-group mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" class="form-control" id="nama" name="nama" value="{{ $pegawai->nama }}">
            @if($errors->has('nama'))
            <span class="text-danger">{{  $errors->first('nama') }}</span>
            @endif
          </div>
          <div class=" form-group mb-3">
            <label for="nip" class="form-label">Nip</label>
            <input type="text" readonly class="form-control" id="nip" name="nip" value="{{ $pegawai->nip }}">
            @if($errors->has('nip'))
            <span class="text-danger">{{  $errors->first('nip') }}</span>
            @endif
          </div>
          <div class="form-group mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <textarea class="form-control" id="alamat" name="alamat" rows="3">{{ $pegawai->alamat }}</textarea>
            @if($errors->has('alamat'))
            <span class="text-danger">{{  $errors->first('alamat') }}</span>
            @endif
          </div>
  
          <div class="mb-3">
            <label for="foto" class="form-label">Pilih Foto, Maksimal Ukuran 1Mb (ekstensi JPG, JPEG, PNG, GIF)</label>
            <input type="file" class="form-control" name="foto" id="foto">
            @if($errors->has('foto'))
            <span class="text-danger">{{  $errors->first('foto') }}</span>
            @endif
          </div>
          <button class="btn btn-primary btn-sm ">Update</button>
        </form> 
  
        <form method="POST" action="{{ url("pegawai/$pegawai->id") }}" class="form-inline">
          @method('DELETE')
          @csrf                 
          <button  type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin menghapus data?.')" >Hapus</button>
          </form>   
  
       
  
  
    
@endsection