@extends('dashboard.layouts.main')
@section('container')
<h2>Edit User : {{ $user->name }}</h2>

<div class="row">
    <div class="col-md-8">
        <form action="/dashboard/user/{{ $user->id }}" method="POST">
            <input type="hidden" name="password" value="{{ $user->password }}">
            @method('PATCH')
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Nama</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $user->name) }}" autofocus>
                @if($errors->has('name'))
                <span class="text-danger">{{  $errors->first('name') }}</span>
                @endif        
            </div>
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" value="{{ old('username', $user->username) }}">
                @if($errors->has('username'))
                <span class="text-danger">{{  $errors->first('username') }}</span>
                @endif        
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $user->email) }}">
                @if($errors->has('email'))
                <span class="text-danger">{{  $errors->first('email') }}</span>
                @endif        
            </div>
            
            <div class="mb-3">
                <label for="email_verified_at" class="form-label">Tgl. Verifikasi Email</label>
                <select class="form-select @error('email_verified_at') is-invalid @enderror" aria-label="Default select example" name="email_verified_at" id="email_verified_at">
                    @php
                      $date = date('Y-m-d H:i:s');  
                    @endphp

                  @if ($user->email_verified_at)
                     <option value="{{ $user->email_verified_at }}" selected>Aktif</option>   
                     <option value="">Tidak</option> 
                  @else
                  <option value="{{ $date }}" >Aktif</option>    
                  <option value="" selected>Tidak</option>
                  @endif                  
                              
                </select>  
                @if($errors->has('email_verified_at'))        
                <span class="text-danger">{{  $errors->first('email_verified_at') }}</span>
                @endif            
            </div>
            <div class="mb-3">
                <label for="is_admin" class="form-label">Role/Hak Akses</label>
                <select class="form-select @error('is_admin') is-invalid @enderror" aria-label="Default select example" name="is_admin" id="is_admin">
                 
                 @if ($user->is_admin)
                    <option value="1" selected>Admin</option>   
                    <option value="0">Operator</option> 
                 @else
                 <option value="1" >Admin</option>    
                 <option value="0" selected>Operator</option>
                 @endif             
                </select>  
                @if($errors->has('is_admin'))        
                <span class="text-danger">{{  $errors->first('is_admin') }}</span>
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

           
            <button type="submit" class="btn btn-primary mb-2">Update</button>   
         </form>
   

         {{-- Reset Password --}}
         {{-- <h2>Reset Password</h2>
         <form action="/dashboard/user/{{ $user->id }}" method="POST">
            <input type="hidden" name="name" value="{{ $user->name }}">
            <input type="hidden" name="username" value="{{ $user->name }}">
            <input type="hidden" name="email" value="{{ $user->email }}">
            <input type="hidden" name="is_admin" value="{{ $user->is_admin }}">
            <input type="hidden" name="email_verified_at" value="{{ $user->email_verified_at }}">
            @method('PATCH')
            @csrf
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

            <button type="submit" class="btn btn-primary mb-2">Save</button> 

         </form> --}}

    </div>
</div>
@endsection