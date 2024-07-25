@extends('dashboard.layouts.main')
@section('container')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Admin Motor
      <a class="btn btn-success btn-sm" href="{{ url('dashboard/motor/create') }}">+ Tambah Data</a>
    </h1>
</div>

 {{-- Form search --}}
 <div class="row">
  <div class="col-md-12">
    <form action="/dashboard/motor">
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
 

  <div class="table-responsive">
    <table class="table table-striped table-sm">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Nama Motor</th>
          <th scope="col">Merek</th>
          <th scope="col">Warna</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($motor as $key => $mtr)
        <tr>
          <td>{{ $motor->firstItem() + $key }}</td>
          <td>
            <a href="{{ "/dashboard/motor/$mtr->id" }}" class="link-dark text-decoration-none">  {{ $mtr->nama_motor }}</a>          
          </td>
          <td>{{ $mtr->merek->nama }}</td>
          <td>{{ $mtr->warna }}</td>
          <td>
            {{-- <a href="{{ "/dashboard/motor/$mtr->id" }}" class="btn btn-success btn-sm">View</a> --}}
            <a href="/dashboard/motor/{{ $mtr->id }}"  class="btn btn-success btn-sm">view</a>                           
            <a href="/dashboard/motor/{{ $mtr->id }}/edit"  class="btn btn-primary btn-sm">Edit</a>                           
            <span class="d-inline-block">
              <form method="POST" action="/dashboard/motor/{{ $mtr->id }}" class="inline-block">
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
  </div>

            {{ $motor->links() }}


@endsection