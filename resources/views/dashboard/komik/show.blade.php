@extends('dashboard.layouts.main')
@section('container')
    

<div class="row mt-3">
    <div class="col-lg-10">
      <div class="card w-50">
        <div class="card-body">
          <img src="{{ url('gambar_komik').'/'. $komik->gambar }}" alt="" class="img img-fluid rounded mb-2">       
          <h5 class="card-title"> {{ $komik->judul }}</h5>
          <h5 class="card-title">Penulis : {{ $komik->penulis }}</h5>    
          <h5 class="card-title">Penerbit : {{ $komik->penerbit }}</h5>    
           <p class="blog-post-meta">Update Data {{ date("d M Y H:i", strtotime($komik->updated_at))  }} </p>
             <a href="{{ url("dashboard/komik") }}" class="btn btn-primary btn-sm">Back</a>
             <a href="/dashboard/komik/{{ $komik->id }}/edit" class="btn btn-secondary btn-sm">Edit</a> 

             <form method="POST" action="{{ url("/dashboard/komik/$komik->id") }}" class="d-inline">
              @method('DELETE')
              @csrf                 
              <button  type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin menghapus data?.')" >Hapus</button>
              </form>

        </div>
    </div>
    </div>
  </div>


@endsection