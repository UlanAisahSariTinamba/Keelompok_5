@extends('dashboard.layouts.main')
@section('container')

<h1>Edit Kategori Berita</h1>

<div class="row">
    <div class="col-md-8">
        <form action="/dashboard/kategori_berita/{{ $kategori_berita->slug }}" method="POST">
            @method('PATCH')
            @csrf
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Kategori</label>
                <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama', $kategori_berita->nama) }}">
                @if($errors->has('nama'))
                <span class="text-danger">{{  $errors->first('nama') }}</span>
                @endif        
            </div>
            <div class="mb-3">
                <label for="slug" class="form-label">Slug</label>
                <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" value="{{ old('slug', $kategori_berita->slug) }}" readonly>
                @if($errors->has('slug'))
                <span class="text-danger">{{  $errors->first('slug') }}</span>
                @endif        
            </div>
            <button class="btn btn-primary">Simpan</button>   
         </form>

    </div>
</div>
    
<script>
    const nama = document.querySelector('#nama');
    const slug = document.querySelector('#slug');
    
    nama.addEventListener('change', function()  {
    fetch('/dashboard/kategori_berita/checkSlug?nama=' + nama.value)
    .then(response => response.json())
    .then(data => slug.value = data.slug)
    
    });
    
    </script>
@endsection