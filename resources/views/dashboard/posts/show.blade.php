@extends('dashboard.layouts.main')
@section('container')

@if (session()->has('success'))
<div class="alert alert-success text-center mt-3" role="alert">
  {{ session('success') }}
</div>        
@endif
        <article class="blog-post">
            <h2 class="blog-post-title mb-1">{{ $post->title }}</h2>
            <p class="blog-post-meta">{{ date("d M Y H:i", strtotime($post->created_at))  }} </p>
            <p>{{ $post->content }}</p>
            <small class="text-muted">{{ $total_comments }} Komentar</small>
            @foreach ($comments as $comment)
                <div class="card mb-3">
                    <div class="card-body">
                        <p style="font-size: 8pt">{{ $comment->comment }} </p>
                    </div>
                </div>
            @endforeach
        </article>
        <a href="{{ url("dashboard/posts") }}"><< Kembali</a>
    
@endsection