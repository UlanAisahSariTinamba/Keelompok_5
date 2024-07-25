@extends('layouts.app')
@section('content')

<div class="row">
    <div class="col-lg-10">
      <div class="card w-50">
        <div class="card-body">
          <img src="{{ url('foto_motor').'/'. $motor->image }}" alt="" width="500" class="img img-fluid rounded mb-2">       
          <h5 class="card-title"> {{ $motor->nama_motor }}</h5>
          <h5 class="card-title">Warna : {{ $motor->warna }}</h5>
          <h5 class="card-title">Merek : {{ $motor->merek->nama }}</h5>
          <h5 class="card-title">Harga : {{ $motor->harga }}</h5>
        
          <p class="blog-post-meta">Update Data {{ date("d M Y H:i", strtotime($motor->created_at))  }} </p>
             <a href="{{ url("motor") }}" class="btn btn-primary">Back</a>
        </div>
    </div>
    </div>
  </div>


@endsection