@extends('president.layouts.dashboard-template')
@section('page-small-title','Dashboard')
@section('page-title','Pending Forms')
@section('content')
<div class="row">
  <div class="col">
    <div class="card card-small rounded-0">
      <div class="card-header border-bottom">
        <h6 class="m-0 text-capitalize">{{ $campus->name }} Pending Form {{ $campus->forms->first()->title }}</h6>
      </div>
      <div class="card-body pb-3 ">
        <iframe style="border:none" src="https://docs.google.com/viewer?url={{$campus->forms->first()->pivot->link}}&embedded=true" width="100%" height="1000px"  ></iframe>

        <br>
         <ul class="list-group" id='comment-box'>
          <label class='font-weight-bold'>Comments: </label>
          <br>
             @foreach($campus->forms->first()->comments as $comment)
              <li class="rounded-0 list-group-item list-group-item-warning font-weight-bold text-dark">
                  <span>{{ $comment->body }}</span>
                  <br>
                  <small class='ml-5 font-weight-bold text-right'>{{ $comment->created_at->diffForHumans() }}</small>
              </li>
              <br>
             @endforeach
          </ul>
      </div>
      <br>
    </div>
  </div>
</div>
<br>
@push('page-scripts')
  <script>
  
  </script>  

@endpush
@endsection