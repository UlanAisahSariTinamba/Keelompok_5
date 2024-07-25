@extends('dashboard.layouts.main')
@section('container')

<h1>Buat Posting Baru</h1>
  <form method="POST" action="{{ url('dashboard/posts') }}">
      @csrf
          <div class="mb-3">
          <label for="title" class="form-label">Judul</label>
          <input type="text" class="form-control @error('title') is-invalid @enderror"  id="title" name="title">
            @error('title')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
          <label for="content" class="form-label">Konten</label>
          <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" rows="3"></textarea>
          @error('content')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
        </div>   
        <button class="btn btn-primary">Simpan</button>    
  </form>
    
@endsection