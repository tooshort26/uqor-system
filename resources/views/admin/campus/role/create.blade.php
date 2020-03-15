@extends('admin.layouts.dashboard-template')
@section('page-small-title','Campus | Add Role')
@section('page-title','Add Role')
@section('content')
@include('templates.error')
@include('templates.form-reminder')
<div class="card card-small mb-4 rounded-0">
    <div class="card-header border-bottom">
      <h6 class="m-0">Role</h6>
    </div>
    <div class="card-body p-3 pb-3">
      <form action="{{ route('role.store') }}" method="POST" id='formForSubmission'>
        @csrf
        <div class="form-group">
        <label>Role</label>
            <input type="text" name='role' class='form-control font-weight-bold' value="{{ old('role') }}" placeholder="Enter Role">  
        </div>
  
        <div class="text-right">
            <input type="submit" value="Add"  id='btnSubmitForm' class='btn btn-primary'>
        </div>
  
      </form>
    </div>
  </div>
@endsection
