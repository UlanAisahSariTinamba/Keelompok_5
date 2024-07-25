@extends('layouts.app')
@section('content')

<h2>Blog Categories</h2>
@foreach ($categories as $category)
<ul>
    <li>
        <a href="/categories/{{ $category->slug }}"> {{ $category->name }}</a> 
    </li>
</ul>

@endforeach    
@endsection