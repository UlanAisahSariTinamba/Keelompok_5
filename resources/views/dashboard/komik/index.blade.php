@extends('dashboard.layouts.main')
@section('container')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Komik
      <a class="btn btn-success btn-sm" href="{{ url('dashboard/komik/create') }}">+ Tambah Data</a>
    </h1>
</div>
    
            {{-- Form search --}}
            <div class="row">
                <div class="col-md-12">
                  <form action="dashboard/komik">
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
  
      <table class="table table-hover">
          <thead>
            <tr>
              <th scope="col">#</th>
              {{-- <th scope="col">Cover</th> --}}
              <th scope="col">Judul</th>
              <th scope="col">Penulis</th>
              <th scope="col">Penerbit</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($komik as $key => $kom)
            <tr>
              <th scope="row">{{ $komik->firstItem() + $key }}</th>                   
              {{-- <td>
                  @if($kom->gambar)
                  <img src="{{ url('gambar_komik').'/'. $kom->gambar }}" alt="" width="100" class="img img-fluid rounded">
                  @endif             
                </td> --}}
              <td>
                <a href="{{ "komik/$kom->id" }}" class="link-dark text-decoration-none">{{ $kom->judul }}</a>                
            </td>
              <td>{{ $kom->penulis }}</td>
              <td>{{ $kom->penerbit }}</td>
              <td>                      
                  <a href="{{ "komik/$kom->id" }}" class="btn btn-success btn-sm">View</a>
                  <a href="{{ "komik/$kom->id/edit" }}" class="btn btn-primary btn-sm">Edit</a>                           
                  <span class="d-inline-block">
                    <form method="POST" action="{{ url("dashboard/komik/$kom->id") }}" class="inline-block">
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
  
  {{ $komik->links() }}

@endsection