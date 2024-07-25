@extends('dashboard.layouts.main')
@section('container')

{{-- Trix editor --}}
<link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.0/dist/trix.css">
<script type="text/javascript" src="https://unpkg.com/trix@2.0.0/dist/trix.umd.min.js"></script>


{{-- Menghilangkan tombol uploud file --}}
<style>
trix-toolbar [data-trix-button-group="file-tools"] {
  display: none;
}
</style>

<h1>Edit Berita</h1>
<form method="POST"  action="/dashboard/berita/{{ $berita->slug }}" enctype="multipart/form-data">
    @method('PUT')
  @csrf
  <div class="mb-3">
      <label for="judul" class="form-label">Judul Berita</label>
      <input type="text" class="form-control @error('judul') is-invalid @enderror" id="judul" name="judul" value="{{ old('judul', $berita->judul )  }}">
      @if($errors->has('judul'))
      <span class="text-danger">{{  $errors->first('judul') }}</span>
      @endif
    </div>
  <div class="mb-3">
      <label for="slug" class="form-label">Slug</label>
      <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" value="{{ old('slug', $berita->slug) }}" readonly>
      @if($errors->has('slug'))
      <span class="text-danger">{{  $errors->first('slug') }}</span>
      @endif
    </div>
    <div class="mb-3">
      <label for="kategori_berita_id" class="form-label">Kategori Berita</label>
      <select class="form-select @error('kategori_berita_id') is-invalid @enderror" aria-label="Default select example" name="kategori_berita_id" id="kategori_berita_id">
       @foreach($kategori as $kateg)
       @if($kateg->id == $berita->kategori_berita_id)
        <option value="{{ $kateg->id }}" selected>{{ $kateg->nama }}</option>
        @else
        <option value="{{ $kateg->id }}">{{ $kateg->nama }}</option>
        @endif
        @endforeach         
      </select>  
      @if($errors->has('kategori'))        
      <span class="text-danger">{{  $errors->first('kategori') }}</span>
      @endif            
  </div>

    {{-- Image Preview --}}       
    <img src="{{ asset('storage/' . $berita->gambar) }}" alt="" class="img img-preview img-fluid rounded mb-2 col-sm-4">    
    <div class="mb-3">
      <label for="gambar" class="form-label text-left">Pilih Gambar, Maksimal Ukuran 1Mb (ekstensi JPG, JPEG, PNG, GIF)</label>
      <input type="hidden" name="oldImage" value="{{ $berita->gambar }}">
      <input type="file" class="form-control @error('gambar') is-invalid @enderror" name="gambar" id="gambar" onchange="previewImage()">       
      @error('gambar')
      <p class="text-danger">{{  $message }}</p>
      @enderror 
    </div>

  <div class="mb-3">     
    <label for="isi_berita" class="form-label">isi Berita</label>
    <input id="isi_berita" type="hidden" name="isi_berita" value="{{ old('isi_berita', $berita->isi_berita) }}" >     
     <trix-editor input="isi_berita"></trix-editor>      
     @error('isi_berita')
     <p class="text-danger">{{  $message }}</p>
     @enderror 
   </div>
    <button type="submit"  class="btn btn-primary">Update</button>

</form><br>
  
<script>
// menggunakan library eloquent-sluggable
const judul = document.querySelector('#judul');
const slug = document.querySelector('#slug');

judul.addEventListener('change', function()  {
fetch('/dashboard/berita/checkSlug?judul=' + judul.value)
.then(response => response.json())
.then(data => slug.value = data.slug)

});

// Image Preview
function previewImage() {
const image = document.querySelector('#gambar');
const imgPreview = document.querySelector('.img-preview');

imgPreview.style.display = 'block';

const oFReader = new FileReader();
oFReader.readAsDataURL(image.files[0]);

oFReader.onload = function(oFREvent) {
  imgPreview.src = oFREvent.target.result;
}
}

document.addEventListener('trix-file-accept', function(e) {
e.preventDefault();
})

</script>
    
@endsection