@extends('dashboard.layouts.main')
@section('container')

  {{-- Pengecekan Notifikasi  --}}
  @if (session()->has('success_message'))
  {{-- Jika ada error/sukses tampilkan pesan --}}
      <div class="alert alert-success text-center mt-3">
          {{ session()->get('success_message') }}
      </div>
  @endif

<h1>Ubah Data Komik</h1>
  



<form method="POST" action="{{ url("dashboard/komik/$komik->id")  }}" enctype="multipart/form-data">   
@method('PATCH')
@csrf
<div class="mb-3">
    <label for="judul" class="form-label">Judul Komik</label>
    <input type="text" class="form-control" id="judul" name="judul" value="{{ $komik->judul }}">
    @if($errors->has('judul'))
    <span class="text-danger">{{  $errors->first('judul') }}</span>
    @endif
  </div>
  <div class="mb-3">
    <label for="penulis" class="form-label">Penulis</label>
    <input type="text" class="form-control" id="penulis" name="penulis" value="{{ $komik->penulis }}">
    @if($errors->has('penulis'))
    <span class="text-danger">{{  $errors->first('penulis') }}</span>
    @endif
  </div>
<div class="mb-3">
    <label for="penerbit" class="form-label">Penerbit</label>
    <input type="text" class="form-control" id="penerbit" name="penerbit" value="{{ $komik->penerbit}}">
    @if($errors->has('penerbit'))
    <span class="text-danger">{{  $errors->first('penerbit') }}</span>
    @endif
  </div>
 
  <div class="row">
    <div class="col-lg-5">
      @if ($komik->gambar)
      <div class="mb-3">
        <img src="{{ url('gambar_komik').'/' . $komik->gambar }}" width="300" class="img-preview  img-fluid">
      </div>
      @else 
      <img class="img-preview img-fluid mb-3 col-sm-5">
    @endif
    </div>
  </div>

  <div class="mb-3">
    {{-- <img class="img-preview img-fluid mb-3 col-sm-5"> --}}
    <label for="gambar" class="form-label">Pilih Gambar, Maksimal Ukuran 1Mb (ekstensi JPG, JPEG, PNG, GIF)</label>
    <input type="file" class="form-control" name="gambar" id="gambar" onchange="previewImage()">
    @if($errors->has('gambar'))
    <span class="text-danger">{{  $errors->first('gambar') }}</span>
    @endif
  </div>
  <button class="btn btn-primary btn-sm mb-3">Update</button>

</form>
    
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