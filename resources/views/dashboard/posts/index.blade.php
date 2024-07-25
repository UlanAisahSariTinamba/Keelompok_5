@extends('dashboard.layouts.main')
@section('container')

    {{-- Pengecekan Erorr  --}}
    @if (session()->has('success_message'))
    {{-- Jika ada error tampilkan pesan --}}
          <div class="alert alert-success text-center">
              {{ session()->get('success_message') }}
          </div>
    @endif
    
      <h3 class="mt-3">
        <a class="btn btn-success btn-sm" href="{{ url('dashboard/posts/create') }}">+ Buat Postingan</a>    
      </h3>  
    
    {{-- Form search --}}
    <div class="row">
        <div class="col-md-12">
          <form action="/dashboard/posts">
            <div class="input-group mb-3">
              <input type="text" class="form-control" placeholder="Search.." name="search" value="{{ request('search') }}">
              <button class="btn btn-primary" type="submit">Search..</button>
            </div>
          </form>
        </div>
      </div>

        @if (session()->has('success'))
        <div class="alert alert-success text-center" role="alert">
          {{ session('success') }}
        </div>        
        @endif
    
            @foreach ($posts as $post)       
            {{-- @php($post = explode(",", $post)) --}}
                 <div class="card mb-3">
                  <div class="card-body">
                  <h5 class="card-title">{{ $post->title }}</h5>
                  <p class="card-text">{{ $post->content }}</p>
                  <p class="card-text"><small class="text-muted"> Last updated at {{ date("d M Y H:i", strtotime($post->created_at))  }}</small></p>
                  <a href="{{ url("dashboard/posts/$post->id") }}" class="btn btn-primary btn-sm">Selengkapnya</a>
                  <a href="{{ url("dashboard/posts/$post->id/edit") }}" class="btn btn-warning btn-sm">Edit</a> 
                  
                  <span class="d-inline-block">
                    <form method="POST" action="{{ url("dashboard/posts/$post->id") }}" class="inline-block">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin menghapus data?.')">Hapus</button>
                    </form>
                </span>

                </div>
              </div>      
            @endforeach

            {{ $posts->links() }}

@endsection