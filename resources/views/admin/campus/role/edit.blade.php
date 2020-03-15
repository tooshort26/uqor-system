@extends('admin.layouts.dashboard-template')
@section('page-small-title','Campus | Add Role')
@section('page-title','Edit'. ucfirst($role->name))
@section('content')
@include('templates.error')
@include('templates.form-reminder')
<div class="card card-small mb-4 rounded-0">
    <div class="card-header border-bottom">
      <h6 class="m-0">{{ ucfirst($role->name) }}</h6>
    </div>
    <div class="card-body p-3 pb-3">
      <form action="{{ route('role.update', $role->id) }}" method="POST" id='formForSubmission'>
        @csrf
        <input name="_method" type="hidden" value="PUT">
        <div class="form-group">
        <label>Role</label>
          <input type="text" name='role' class='form-control font-weight-bold' value="{{ old('role') }} {{ $role->name }}" placeholder="Enter Role">  
        </div>
  
        <div class="text-right">
            <input type="submit" value="Update"  id='btnSubmitForm' class='btn btn-primary'>
        </div>
  
      </form>
    </div>
  </div>
@endsection
