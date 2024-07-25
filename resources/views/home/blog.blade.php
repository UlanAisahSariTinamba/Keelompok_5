
@extends('layouts.app')
@section('content')

<article>
<h2>{{ $posts->title }}</h2>
<h5>By : Affanul in 
    <a href="/categories/{{ $posts->category->slug }}">{{ $posts->category->name }}</a>    
</h5>
<p>{!! $posts->body !!}</p>
</article>
<a href="/blog">Back to blog</a>
@endsection
