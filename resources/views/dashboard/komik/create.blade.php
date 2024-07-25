@extends('dashboard.layouts.main')
@section('container')

<h1>Tambah Data Komik</h1>
<form method="POST"  action="/dashboard/komik" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label for="judul" class="form-label">Judul Komik</label>
        <input type="text" class="form-control" id="judul" name="judul" value="{{ old('judul') }}">
        @if($errors->has('judul'))
        <span class="text-danger">{{  $errors->first('judul') }}</span>
        @endif
      </div>
    <div class="mb-3">
        <label for="penulis" class="form-label">Penulis</label>
        <input type="text" class="form-control" id="penulis" name="penulis" value="{{ old('penulis') }}">
        @if($errors->has('penulis'))
        <span class="text-danger">{{  $errors->first('penulis') }}</span>
        @endif
      </div>
    <div class="mb-3">
        <label for="penerbit" class="form-label">Penerbit</label>
        <input type="text" class="form-control" id="penerbit" name="penerbit" value="{{ old('penerbit') }}">
        @if($errors->has('penerbit'))
        <span class="text-danger">{{  $errors->first('penerbit') }}</span>
        @endif
      </div>
       
   
      {{-- Image Preview --}}          
      <img class="img-preview img-rounded col-sm-4">        
      <div class="mb-3">
        <label for="gambar" class="form-label text-left">Pilih Gambar, Maksimal Ukuran 1Mb (ekstensi JPG, JPEG, PNG, GIF)</label>
        <input type="file" class="form-control" name="gambar" id="gambar" onchange="previewImage()">
        @if($errors->has('gambar'))
        <span class="text-danger">{{  $errors->first('gambar') }}</span>
        @endif
      </div>
      <button class="btn btn-primary">Simpan</button>

</form><br>
    
<script>

  // Script image preview
  function previewImage() {
    const gambar = document.querySelector('#gambar');
    const imgPreview = document.querySelector('.img-preview');
  
    imgPreview.style.display = 'block';
  
    const oFReader = new FileReader();
    oFReader.readAsDataURL(gambar.files[0]);
  
    oFReader.onload = function(oFREvent) {
      imgPreview.src = oFREvent.target.result;
    }
  }
  
  </script>

@endsection