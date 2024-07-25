@extends('layouts.app')
@section('title', 'Ubah Blog')
@section('content')
    
<h1>Ubah Posting Baru</h1>
<form method="POST" action="{{ url("posts/$post->id") }}">
  @method('PATCH')
    @csrf
        <div class="mb-3">
        <label for="title" class="form-label">Judul</label>
        <input type="text" class="form-control" id="title" name="title" value="{{ $post->title }}">
      </div>
      <div class="mb-3">
        <label for="content" class="form-label">Konten</label>
        <textarea class="form-control" id="content" name="content" rows="3" >{{ $post->content }}</textarea>
      </div>
      <button class="btn btn-primary">Update</button>    
</form><br>
<form method="POST" action="{{ url("posts/$post->id") }}">
  @method('DELETE')
  @csrf
  <button type="submit" class="btn btn-danger">Hapus</button>
</form>

@endsection
