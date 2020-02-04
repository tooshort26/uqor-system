@extends('campus.layouts.dashboard-template')
@section('page-small-title','Campus')
@section('page-title','Account setting')
@section('content')
<div class="row">
  <div class="col">
    @include('templates.success')
    @include('templates.error')
    <div class="card card-small rounded-0">
      <div class="card-header border-bottom">
        <h6 class="m-0">Account setting form</h6>
      </div>
      <div class="card-body  pb-3">
        <form action="{{ route('campus.account.setting.update') }}" method="POST" enctype='multipart/form-data'>
          @csrf
          @method('PUT')

          <div class="form-group">
            <label>Password</label>
            <input type="password" name='password' class='form-control font-weight-bold' placeholder='Enter your new password here..'>
          </div>

          <div class="form-group">
            <label>Re-type Password</label>
            <input type="password" name='password_confirmation' class='form-control font-weight-bold' placeholder='Re-type new password here..'>
          </div>
          
          <div class="form-group">
            <label>Profile</label>
            <input type="file" name="profile" class='form-control font-weight-bold'>
          </div>

          
          <input type="submit" value="Update password" class='btn btn-success font-weight-bold float-right'>
          <div class="clearfix"></div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection