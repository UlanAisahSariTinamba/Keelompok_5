@extends('layouts.app')
@section('title', 'Selamat datang')
@section('content')
    
<h1>Blog Ilmuweb.NET
    <a class="btn btn-success" href="{{ url('posts/create') }}">+ Buat Postingan</a>    
    </h1>  

    @if (session()->has('success'))
    <div class="alert alert-success" role="alert">
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
              <a href="{{ url("posts/$post->id") }}" class="btn btn-primary">Selengkapnya</a>
              <a href="{{ url("posts/$post->id/edit") }}" class="btn btn-warning">Edit</a>
              
            </div>
          </div>      
        @endforeach

@endsection



       