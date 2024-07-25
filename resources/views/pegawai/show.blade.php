@extends('layouts.app')
@section('content') 

<div class="row">
  <div class="col-lg-10">
    <div class="card w-50">
      <div class="card-body">
        <img src="{{ url('foto').'/'. $pegawai->foto }}" alt="" width="500" class="img img-fluid rounded mb-2">       
        <h5 class="card-title">Nama : {{ $pegawai->nama }}</h5>
        <h5 class="card-title">Alamat : {{ $pegawai->alamat }}</h5>
        <h5 class="card-title">NIP : {{ $pegawai->nip }}</h5>
      
        <p class="blog-post-meta">Update Data {{ date("d M Y H:i", strtotime($pegawai->created_at))  }} </p>
           <a href="{{ url("pegawai") }}" class="btn btn-primary">Back</a>
      </div>
  </div>
  </div>
</div>


@endsection