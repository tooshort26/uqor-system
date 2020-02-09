@extends('admin.layouts.dashboard-template')
@section('page-small-title','Admin')
@section('page-title','Update your profile')
@section('content')
<div class="row">
  <div class="col">
    @include('templates.success')
    @include('templates.error')
    <div class="card card-small rounded-0">
      <div class="card-header border-bottom">
        <h6 class="m-0">Update profile form</h6>
      </div>
      <div class="card-body  pb-3">
        <form action="{{ route('president.profile.update') }}" method="POST" enctype='multipart/form-data'>
          @csrf
          @method('PUT')

          <div class="form-group">
            <label>Name</label>
            <input type="text" name='name' class='form-control font-weight-bold' value='{{ Auth::user()->name }}'>
          </div>

          <div class="form-group">
            <label>Email</label>
            <input type="email" name='email' class='form-control font-weight-bold' value='{{ Auth::user()->email }}'>
          </div>

          <div class="form-group">
            <label>Password</label>
            <input type="password" name='password' class='form-control font-weight-bold' placeholder='Enter your new password here..'>
          </div>

          <div class="form-group">
            <label>Re-type Password</label>
            <input type="password" name='password_confirmation' class='form-control font-weight-bold' placeholder='Re-type new password here..'>
          </div>

          <div class="form-group">
            <label>Update profile</label>
            <input type="file" name='profile' class='form-control font-weight-bold'>
          </div>
          
          
          <input type="submit" value="Update profile" class='btn btn-success font-weight-bold float-right'>
          <div class="clearfix"></div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection