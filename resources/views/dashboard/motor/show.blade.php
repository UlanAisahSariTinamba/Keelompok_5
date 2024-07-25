@extends('dashboard.layouts.main')
@section('container')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-2 ">
  
</div>

<div class="row mb-3">
    <div class="col-lg-10">
      <div class="card w-50">
        <div class="card-body">
          <img src="{{ url('foto_motor').'/'. $motor->image }}" alt="" width="500" class="img img-fluid rounded mb-2">       
          <h5 class="card-title"> {{ $motor->nama_motor }}</h5>
          <h5 class="card-title">Warna : {{ $motor->warna }}</h5>
          <h5 class="card-title">Merek : {{ $motor->merek->nama }}</h5>
          <h5 class="card-title">Harga : {{ $motor->harga }}</h5>
        
          <p class="blog-post-meta">Update Data {{ date("d M Y H:i", strtotime($motor->created_at))  }} </p>
             <a href="{{ url("dashboard/motor") }}" class="btn btn-primary btn-sm">Back</a>
             <a href="/dashboard/motor/{{ $motor->id }}/edit" class="btn btn-secondary btn-sm">Edit</a>

             <form method="POST" action="{{ url("/dashboard/motor/$motor->id") }}" class="d-inline">
              @method('DELETE')
              @csrf                 
              <button  type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin menghapus data?.')" >Hapus</button>
              </form>
        </div>
    </div>
    </div>
  </div>

    
@endsection