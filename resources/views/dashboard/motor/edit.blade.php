@extends('dashboard.layouts.main')
@section('container')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-2 ">
</div>


<h1>Edit Data Motor</h1>
<img src="{{ url('foto_motor').'/'. $motor->image }}" alt="" width="300" class="img img-fluid rounded mb-2">       

<form action="{{ url("dashboard/motor/$motor->id ") }}" method="post" enctype="multipart/form-data">
   @method('put') 
   @csrf
    <div class="mb-3">
        <label for="nama_motor" class="form-label">Nama Motor</label>
        <input type="text" class="form-control @error('nama_motor') is-invalid @enderror" id="nama_motor" name="nama_motor" value="{{  old('nama_motor', $motor->nama_motor ) }}">
        @if($errors->has('nama_motor'))
        <span class="text-danger">{{  $errors->first('nama_motor') }}</span>
        @endif        
    </div>
    <div class="mb-3">
        <label for="merek_id" class="form-label">Merek Motor</label>
        <select class="form-select" name="merek_id">             
            @foreach ($merek as $mrk)
            @if(old('merek_id', $motor->merek_id) == $mrk->id)
            <option value="{{ $mrk->id }}" selected>{{ $mrk->nama }}</option>                
            @else 
            <option value="{{ $mrk->id }}" >{{ $mrk->nama }}</option>
            @endif                
            @endforeach           
          </select>         
           
    </div>
    <div class="mb-3">
        <label for="warna" class="form-label">Warna Motor</label>
        <input type="text" class="form-control @error('warna') is-invalid @enderror" id="warna" name="warna" value="{{ old('warna', $motor->warna) }}">
        @if($errors->has('warna'))
        <span class="text-danger">{{  $errors->first('warna') }}</span>
        @endif        
    </div>
    <div class="mb-3">
        <label for="harga" class="form-label">Harga</label>
        <input type="number" class="form-control @error('harga') is-invalid @enderror" id="harga" name="harga" value="{{ old('harga', $motor->harga) }}">
        @if($errors->has('harga'))
        <span class="text-danger">{{  $errors->first('harga') }}</span>
        @endif        
    </div>
    <div class="mb-3">
        <label for="foto" class="form-label">Pilih Foto, Maksimal Ukuran 1Mb (ekstensi JPG, JPEG, PNG, GIF)</label>
        <input type="file" class="form-control @error('foto') is-invalid @enderror" name="foto" id="foto">
        @if($errors->has('foto'))
        <span class="text-danger">{{  $errors->first('foto') }}</span>
        @endif
      </div>

      <button class="btn btn-primary mb-2">Update</button>   



@endsection