@extends('layouts.app')
@section('content')
<h1>Kategori Merek Motor
    <a class="btn btn-success" href="{{ url('merek/create') }}">+ Tambah Data</a> 
</h1>
    
  {{-- Form search --}}
  <div class="row">
    <div class="col-md-8">
      <form action="/merek">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Search.." name="search" value="{{ request('search') }}">
          <button class="btn btn-primary" type="submit">Search..</button>
        </div>
      </form>
    </div>
  </div>
  
  {{-- Notifikasi Sukses --}}
  <div class="row">
    <div class="col-md-8">       
        @if (session()->has('success_message'))
        {{-- Jika ada error tampilkan pesan --}}
            <div class="alert alert-success">
                {{ session()->get('success_message') }}
            </div>
        @endif        
    </div>
  </div>

  <div class="row">
    <div class="col-md-8">
        {{-- Tabel Kategori Merek Motor --}}
        <table class="table table-hover">
            <thead>
              <tr>
                <th scope="col">#</th>        
                <th scope="col">Merek Motor</th>      
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($merek as $key => $mrk)
              <tr>
                <th scope="row">{{ $merek->firstItem() + $key }}</th>              
                <td>{{ $mrk->nama }}</td>    
                <td>                      
                    <a href="{{ "merek/$mrk->id" }}" class="btn btn-success btn-sm">View</a>
                    <a href="{{ "merek/$mrk->id/edit" }}" class="btn btn-primary btn-sm">Edit</a>                           
                    <span class="d-inline-block">
                      <form method="POST" action="{{ url("merek/$mrk->id") }}" class="inline-block">
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
        {{ $merek->links() }}
    </div>
  </div>
  

@endsection