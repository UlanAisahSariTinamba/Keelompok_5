
@extends('dashboard.layouts.main')
@section('container')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Berita
      <a class="btn btn-success btn-sm" href="/dashboard/berita/create">+ Tambah Data</a>
    </h1>
</div>

            {{-- Form search --}}
            <div class="row">
                <div class="col-md-12">
                  <form action="/dashboard/berita">
                    @if(request('kategori'))
                      <input type="hidden" name="kategori" value="{{ request('kategori') }}">
                    @endif
                    <div class="input-group mb-3">
                      <input type="text" class="form-control" placeholder="Search.." name="search" value="{{ request('search') }}">
                      <button class="btn btn-primary" type="submit">Search..</button>
                    </div>
                  </form>
                </div>
              </div>

              {{-- Pengecekan Erorr  --}}
              @if (session()->has('success_message'))
              {{-- Jika ada error tampilkan pesan --}}
                  <div class="alert alert-success text-center">
                      {{ session()->get('success_message') }}
                  </div>
              @endif

  @if($berita->count())                  
 {{-- Tabel Berita --}}
 <table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">#</th>                  
      <th scope="col">Judul</th>
      <th scope="col">User</th>
      <th scope="col">Kategori</th>
      <th scope="col">Publish at</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>               
    @foreach ($berita as $key => $brt)
    <tr>                               
      <th scope="row">{{ $berita->firstItem() + $key }}</th>                   
      {{-- <td>
          @if($brt->gambar)
          <img src="{{ url('gambar_komik').'/'. $brt->gambar }}" alt="" width="100" class="img img-fluid rounded">
          @endif             
        </td> --}}
      <td>
        <a href="/dashboard/berita/{{ $brt->slug }}" class="link-dark text-decoration-none">{{ $brt->judul }}</a>                
    </td>
      <td>{{ $brt->user->name }}</td>
      <td>
      <a href="/dashboard/berita/kategori/{{ $brt->kategori_berita->slug }}" class="link-dark link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover"> {{ $brt->kategori_berita->nama }}</a>      
      </td>
      <td>{{ $brt->published_at }}</td>
      <td>                      
          <a href="{{ "berita/$brt->slug" }}" class="btn btn-success btn-sm">View</a>
          <a href="berita/{{ $brt->slug }}/edit"class="btn btn-primary btn-sm">Edit</a>                           
          <span class="d-inline-block">
            <form method="POST" action="/dashboard/berita/{{ $brt->slug }}" class="inline-block">
              @method('DELETE')
              @csrf                 
              <button  type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin menghapus data?.')" >Hapus</button>
              </form>
          </span>        
      </td>
    </tr>    
    @endforeach
  </tbody>
</table>
  @else
  <p class="fs-5"> <b> No search found. </b> </p>
  @endif            

    {{ $berita->links() }}
        
@endsection