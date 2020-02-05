@extends('admin.layouts.dashboard-template')
@section('page-small-title','Dashboard')
@section('page-title','Pending Forms')
@section('content')
@include('templates.form-reminder')
<div class="row">
  <div class="col">
    <div class="card card-small rounded-0">
      <div class="card-header border-bottom">
        <h6 class="m-0 text-capitalize">{{ $campusWithForm->name }} Pending Form {{ $campusWithForm->forms->first()->title }}</h6>
      </div>
      <div class="card-body pb-3 ">
        <iframe style="border:none" src="https://docs.google.com/viewer?url={{public_path() . '\\campus_forms\\' . md5($campusWithForm->name) .'_'. $campusWithForm->forms->first()->link }}&embedded=true" width="100%" height="900px"  />
      </div>
    </div>
  </div>
</div>
@endsection