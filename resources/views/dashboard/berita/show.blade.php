@extends('dashboard.layouts.main')
@section('container')



<div class="row mt-3">
    <div class="col-lg-10">
      <div class="card w-50">
        <div class="card-body">
          <img src="{{ asset('storage/' . $berita->gambar) }}" alt="" class="img img-fluid rounded mb-2">       
          <h5 class="card-title"> {{ $berita->judul }}</h5>
          {{-- menampilkan data tag html --}}
          <p class="card-title">{!!  $berita->isi_berita   !!}</p>    
          <b class="card-title">Penulis : {{ $berita->user->name }}</b>    
           <p class="blog-post-meta">Update Data {{ date("d M Y H:i", strtotime($berita->updated_at))  }} </p>
             <a href="{{ url("dashboard/berita") }}" class="btn btn-primary btn-sm">Back</a>
             <a href="/dashboard/berita/{{ $berita->slug }}/edit" class="btn btn-secondary btn-sm">Edit</a> 

             <form method="POST" action="{{ url("/dashboard/berita/$berita->slug") }}" class="d-inline">
              @method('DELETE')
              @csrf                 
              <button  type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin menghapus data?.')" >Hapus</button>
              </form>

        </div>
    </div>
    </div>
  </div>

   
@endsection