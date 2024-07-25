@extends('layouts.app')
@section('content')
    
<h1 class="mb-3">Daftar Motor
    <a class="btn btn-success" href="{{ url('motor/create') }}">+ Tambah Data</a>    
    </h1>
    
                {{-- Form search --}}
                <div class="row">
                    <div class="col-md-12">
                      <form action="/motor">
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
                        <th scope="col">Nama Motor</th>
                        <th scope="col">Merek</th>
                        <th scope="col">Warna</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($motor as $key => $mtr)
                      <tr>
                        <th scope="row">{{ $motor->firstItem() + $key }}</th>                   
                        {{-- <td>
                            @if($mtr->gambar)
                            <img src="{{ url('gambar_motor').'/'. $mtr->gambar }}" alt="" width="100" class="img img-fluid rounded">
                            @endif             
                          </td> --}}
                        <td>{{ $mtr->nama_motor }}</td>
                        <td>{{ $mtr->merek->nama }}</td>
                        <td>{{ $mtr->warna }}</td>
                        <td>{{ $mtr->harga }}</td>
                        <td>                      
                            <a href="{{ "motor/$mtr->id" }}" class="btn btn-success btn-sm">View</a>
                            <a href="/motor/{{ $mtr->id }}/edit"  class="btn btn-primary btn-sm">Edit</a>                           
                            <span class="d-inline-block">
                              <form method="POST" action="/motor/{{ $mtr->id }}" class="inline-block">
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
            
            {{ $motor->links() }}

@endsection