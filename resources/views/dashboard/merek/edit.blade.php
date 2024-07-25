
@extends('dashboard.layouts.main')
@section('container')

<h1>Edit Kategori</h1>
<div class="row">
    <div class="col-md-8">
        <form action="/dashboard/merek/{{ $merek->id }}" method="POST">
           
            @method('PUT')
            @csrf
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Kategori</label>
                <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama', $merek->nama) }}">
                @if($errors->has('nama'))
                <span class="text-danger">{{  $errors->first('nama') }}</span>
                @endif        
            </div>
            <button class="btn btn-primary">Simpan</button>   
         </form>

    </div>
</div>
    
@endsection