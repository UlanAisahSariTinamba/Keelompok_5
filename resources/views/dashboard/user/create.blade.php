@extends('dashboard.layouts.main')
@section('container')

<h1>Tambah User</h1>
<div class="row">
    <div class="col-md-8">
        <form action="/dashboard/user" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Nama</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" autofocus>
                @if($errors->has('name'))
                <span class="text-danger">{{  $errors->first('name') }}</span>
                @endif        
            </div>
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" >
                @if($errors->has('username'))
                <span class="text-danger">{{  $errors->first('username') }}</span>
                @endif        
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email">
                @if($errors->has('email'))
                <span class="text-danger">{{  $errors->first('email') }}</span>
                @endif        
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password">
                @if($errors->has('password'))
                <span class="text-danger">{{  $errors->first('password') }}</span>
                @endif
            </div>
            <div class="mb-3">
                <label for="password_confirmation" class="form-label"> Konfirmasi Password</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
            </div>
            <div class="mb-3">
                <label for="email_verified_at" class="form-label">Tgl. Verifikasi Email</label>
                <select class="form-select @error('email_verified_at') is-invalid @enderror" aria-label="Default select example" name="email_verified_at" id="email_verified_at">
                    @php
                      $date = date('Y-m-d H:i:s');                   
                    @endphp
                  <option value="" >- select -</option>                
                  <option value="{{ $date }}">Aktif</option>                
                  <option value="">Tidak</option>
                </select>  
                @if($errors->has('email_verified_at'))        
                <span class="text-danger">{{  $errors->first('email_verified_at') }}</span>
                @endif            
            </div>
            <div class="mb-3">
                <label for="is_admin" class="form-label">Role/Hak Akses</label>
                <select class="form-select @error('is_admin') is-invalid @enderror" aria-label="Default select example" name="is_admin" id="is_admin">
                  <option value="" >- select -</option>                
                  <option value="0">Operator</option>                
                  <option value="1">Admin</option>
                </select>  
                @if($errors->has('is_admin'))        
                <span class="text-danger">{{  $errors->first('is_admin') }}</span>
                @endif            
            </div>
           
            <button type="submit" class="btn btn-primary">Simpan</button>   
         </form>

    </div>
</div>
    
@endsection