@extends('layouts.app')
@section('content')
    <h1 class="mb-3">Daftar Pegawai
      <a class="btn btn-success" href="{{ url('pegawai/create') }}">+ Tambah Data</a>    
      </h1>

            {{-- Form search --}}
            <div class="row">
              <div class="col-md-12">
                <form action="/pegawai">
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
                <div class="alert alert-success">
                    {{ session()->get('success_message') }}
                </div>
            @endif

    <table class="table table-hover">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Foto</th>
            <th scope="col">NIP</th>
            <th scope="col">Nama</th>
            <th scope="col">Alamat</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($pegawai as $key => $peg)
          <tr>
            <th scope="row">{{ $pegawai->firstItem() + $key }}</th>
            <td>
            @if($peg->foto)
            <img src="{{ url('foto').'/'. $peg->foto }}" alt="" width="100" class="img img-fluid rounded">
            @endif             
          </td>
          <td>{{ $peg->nip }}</td>
            <td>{{ $peg->nama }}</td>
            <td>{{ $peg->alamat }}</td>
            <td>            
          
                <a href="{{ "pegawai/$peg->id" }}" class="btn btn-success btn-sm">View</a>
                <a href="{{ "pegawai/$peg->id/edit" }}" class="btn btn-primary btn-sm">Edit</a>                           
                  
                <span class="d-inline-block">
                  <form method="POST" action="{{ url("pegawai/$peg->id") }}" class="inline-block">
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

{{ $pegawai->links() }}

{{-- untuk menggunakan link paginate tambahkan  --}}
{{-- Use bootstrap
App\Providers\AppServiceProvider
public function boot()
{
    Paginator::useBootstrapFive();
 
} --}}


@endsection