@extends('dashboard.layouts.main')
@section('container')


<div class="row mt-3">
    <div class="col-lg-10">
      <div class="card w-50">
        <div class="card-body">
          @if($pegawai->foto)
          <img src="{{ url('foto').'/'. $pegawai->foto }}" alt="" width="300" class="img img-fluid rounded mb-2">      
          @else 
          <img src="/foto/default.png" alt="" width="300" class="img img-fluid rounded"> 
          @endif

          <h5 class="card-title">Nama : {{ $pegawai->nama }}</h5>
          <h5 class="card-title">Alamat : {{ $pegawai->alamat }}</h5>
          <h5 class="card-title">NIP : {{ $pegawai->nip }}</h5>
        
          <p class="blog-post-meta">Update Data {{ date("d M Y H:i", strtotime($pegawai->created_at))  }} </p>
             <a href="{{ url("dashboard/pegawai") }}" class="btn btn-primary btn-sm">Back</a>
             <a href="/dashboard/pegawai/{{ $pegawai->id }}/edit" class="btn btn-secondary btn-sm">Edit</a>

             <form method="POST" action="{{ url("/dashboard/pegawai/$pegawai->id") }}" class="d-inline">
              @method('DELETE')
              @csrf                 
              <button  type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin menghapus data?.')" >Hapus</button>
              </form>


        </div>
    </div>
    </div>
  </div>
  


@endsection