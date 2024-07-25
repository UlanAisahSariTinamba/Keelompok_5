@extends('dashboard.layouts.main')
@section('container')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Pegawai
      <a class="btn btn-success btn-sm text-center" href="{{ url('dashboard/pegawai/create') }}">+ Tambah Data</a>
    </h1>
</div>

    {{-- Form search --}}
    <div class="row">
        <div class="col-md-12">
          <form action="/dashboard/pegawai">
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
            <th scope="col">Foto</th>
            <th scope="col">NIP</th>
            <th scope="col">Nama</th>
            <th scope="col">Alamat</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($pegawai as $key => $peg)
          <tr class="align-middle">
            <th scope="row">{{ $pegawai->firstItem() + $key }}</th>
            <td>
            @if($peg->foto)
            <a href="{{ "/dashboard/pegawai/$peg->id" }}">
              <img src="{{ url('foto').'/'. $peg->foto }}" alt="" width="100" class="img img-fluid rounded">
            </a>
            @else
            <a href="{{ "/dashboard/pegawai/$peg->id" }}">
              <img src="/foto/default.png" alt="" width="100" class="img img-fluid rounded">
            </a>
            @endif             
          </td>
          <td >{{ $peg->nip }}</td>
            <td>{{ $peg->nama }}</td>
            <td>{{ $peg->alamat }}</td>
            <td>           
          
                <a href="{{ "/dashboard/pegawai/$peg->id" }}" class="btn btn-success btn-sm">View</a>
                <a href="{{ "/dashboard/pegawai/$peg->id/edit" }}" class="btn btn-primary btn-sm">Edit</a>                           
                  
                <span class="d-inline-block">
                  <form method="POST" action="{{ url("/dashboard/pegawai/$peg->id") }}" class="inline-block">
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


    
@endsection