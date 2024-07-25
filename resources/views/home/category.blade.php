@extends('layouts.app')
@section('content')

<h2>Blog Category : {{ $category }}</h2>
@foreach ($posts as $post)
<article class="mb-5">
    <h2>
    <a href="/blog/{{ $post['slug'] }}"> {{ $post['title'] }}</a> 
    </h2>
    <h5>By : Affanul </h5>
    <p>{!! $post['body'] !!}</p>    
</article>

@endforeach    
@endsection