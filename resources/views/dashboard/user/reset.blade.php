@extends('dashboard.layouts.main')
@section('container')

 {{-- Reset Password --}}
 <h2>Reset Password</h2>
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

 </form>






@endsection