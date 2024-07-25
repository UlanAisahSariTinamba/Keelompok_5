@extends('layouts.app')
@section('content')
   
<div class="row justify-content-center">
  <div class="col-md-5">
    <div class="card mt-5">
      <div class="card-header">
      <h1 class="h3 mb-3 fw-normal text-center">Please login</h1>
      </div>
      <div class="card-body">
        

      {{-- Pesan Alert Success --}}
      @if(session()->has('success_message'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
       {{ session('success_message') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      @endif

      {{-- Pesan Alert Login Error --}}
      @if(session()->has('loginError'))
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
       {{ session('loginError') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      @endif

    <main class="form-signin w-100 m-auto">
      <form action="/login_wpu" method="POST">
        @csrf
        <div class="form-floating">
          <input type="email"  name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="name@example.com" autofocus required value="{{ old('email') }}">
          <label for="email" >Email address</label>
          @error('email')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
          @enderror
        </div>
        <div class="form-floating">
          <input type="password" name="password" class="form-control" id="password" placeholder="Password" required>
          <label for="password">Password</label>
        </div>        
        <button class="w-100 btn btn-lg btn-primary" type="submit">Login</button>     
      </form>
      <small class="d-block text-secondary text-center mt-3">Not register? <a href="/register_wpu">Register Now</a></small>
    </main>
      </div>
    </div>
  </div>
</div>

    
@endsection