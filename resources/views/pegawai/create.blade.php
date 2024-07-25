@extends('layouts.app')
  @section('content')
     
  <h1>Tambah Data Pegawai</h1>
  <form method="POST" action="/pegawai" enctype="multipart/form-data">
      @csrf
        <div class="mb-3">
          <label for="nama" class="form-label">Nama</label>
          <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama') }}">
          @if($errors->has('nama'))
          <span class="text-danger">{{  $errors->first('nama') }}</span>
          @endif
        </div>
        <div class="mb-3">
          <label for="nip" class="form-label">Nip</label>
          <input type="text" class="form-control" id="nip" name="nip" value="{{ old('nip') }}">
          @if($errors->has('nip'))
          <span class="text-danger">{{  $errors->first('nip') }}</span>
          @endif
        </div>
        <div class="mb-3">
          <label for="alamat" class="form-label">Alamat</label>
          <textarea class="form-control" id="alamat" name="alamat" rows="3" >{{ old('alamat') }}</textarea>
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

        <button class="btn btn-primary">Simpan</button>    
  </form>
  
 @endsection


