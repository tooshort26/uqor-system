@extends('admin.layouts.dashboard-template')
@section('page-small-title','Campus')
@section('page-title','Campus ' . ucfirst($campus->name) . ' Profile')
@section('content')
<div class="row">
  <div class="col">
    <div class="card card-small rounded-0">
      <div class="card-header border-bottom">
        <h6 class="m-0">Campus Information</h6>
      </div>
      <div class="card-body  pb-3">
        <div class="form-group">
          <label class='font-weight-bold'>Campus Name</label>
          <input type="text" class='font-weight-bold form-control' readonly value={{ $campus->name }}>
        </div>
        <div class="form-group">
          <label class='font-weight-bold'>Campus Email</label>
          <input type="text"  class='font-weight-bold form-control' readonly value={{ $campus->email }}>
        </div>
        <div class="form-group">
          <label class='font-weight-bold'>Campus Address</label>
          <textarea readonly class='font-weight-bold form-control' id="" cols="30" rows="10">{{ $campus->address }}</textarea>
        </div>
        <hr>
        <h5>Submitted Forms : </h5>
        @foreach($groupByQuarter  as $yearAndQuarter => $form)
        <ul class="list-group">
          <li class="list-group-item font-weight-bold active">Year & Quarter : {{ $yearAndQuarter }}</li>
          @foreach($form as $f)
            <li class="list-group-item font-weight-bold text-capitalize">
              Title : <span class='text-primary'>{{ $f->title }}</span> <br> 
              Description : <span class='text-primary'> {{ $f->description }}</span>
              <br>
              Submitted Date : <span class='text-primary'> {{ $f->created_at->format('F d, Y H:m A') }}</span>
              <br>
              <a href="{{ route('download.campus.submitted.form', [$f->link, $campus]) }}"><u>Download</u></a>
            </li>
          @endforeach
        </ul>
        @endforeach
      </div>
    </div>
  </div>
</div>

@endsection