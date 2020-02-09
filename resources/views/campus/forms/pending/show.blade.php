@extends('campus.layouts.dashboard-template')
@section('page-small-title','Dashboard')
@section('page-title','Form' . $campusWithForm->name )
@section('content')
@include('templates.form-reminder')
<div class="row">
  <div class="col">
    <div class="card card-small rounded-0">
      {{-- <div class="card-header border-bottom">
        <h6 class="m-0 text-capitalize">{{ $campusWithForm->name }} Pending Form {{ $campusWithForm->forms->first()->title }}</h6>
      </div> --}}
      <div class="card-body pb-3 ">
        
        <iframe style="border:none" src="https://docs.google.com/viewer?url={{ $campusWithForm->forms->first()->pivot->link }}&embedded=true" width="100%" height="1000px"  ></iframe>
        
        <br>
        <div class="form-group">
          <br>

          <ul class="list-group" id='comment-box'>
          <label class='font-weight-bold'>Comments: </label>
             @foreach($campusWithForm->forms->first()->comments as $comment)
              <li class="rounded-0 list-group-item list-group-item-warning font-weight-bold text-dark">
                  <span>{{ $comment->body }}</span>
                  <br>
                  <small class='ml-5 font-weight-bold text-right'>{{ $comment->created_at->diffForHumans() }}</small>
              </li>
              <br>
             @endforeach
          </ul>
          <br>
        </div>
      </div>
      <br>
    </div>
  </div>
</div>
@endsection