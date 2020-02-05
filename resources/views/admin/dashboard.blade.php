@extends('admin.layouts.dashboard-template')
@section('page-small-title','Dashboard')
@section('page-title','Overview')
@section('content')
<!-- Default Light Table -->
@include('templates.success')
@include('templates.error')
@include('templates.form-reminder')
<div class="row">
 <div class="col-lg col-md-6 col-sm-6 mb-4">
    <div class="stats-small stats-small--1 card card-small rounded-0">
      <div class="card-body p-0 d-flex">
        <div class="d-flex flex-column m-auto">
          <div class="stats-small__data text-center">
            <span class="stats-small__label text-uppercase text-primary">current quarter</span>
            <h6 class="stats-small__value count my-3">{{ \Carbon\Carbon::now()->quarter }}</h6>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-lg col-md-6 col-sm-6 mb-4">
    <div class="stats-small stats-small--1 card card-small rounded-0">
      <div class="card-body p-0 d-flex">
        <div class="d-flex flex-column m-auto">
          <div class="stats-small__data text-center">
            <span class="stats-small__label text-uppercase text-primary">No. of campus</span>
            <h6 class="stats-small__value count my-3">{{ $noOfCampus }}</h6>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg col-md-6 col-sm-6 mb-4">
    <div class="stats-small stats-small--1 card card-small rounded-0">
      <div class="card-body p-0 d-flex">
        <div class="d-flex flex-column m-auto">
          <div class="stats-small__data text-center">
            <span class="stats-small__label text-uppercase text-primary">No. of uploaded forms</span>
            <h6 class="stats-small__value count my-3">{{ $noOfForms }}</h6>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg col-md-6 col-sm-6 mb-4">
    <div class="stats-small stats-small--1 card card-small rounded-0">
      <div class="card-body p-0 d-flex">
        <div class="d-flex flex-column m-auto">
          <div class="stats-small__data text-center">
            <span class="stats-small__label text-uppercase text-primary">no. of campus submitted forms</span>
            <h6 class="stats-small__value count my-3">{{ $noOfCampusSubmittedForms }}</h6>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>

<div class="row">
  <div class="col">
    <div class="card card-small rounded-0">
      <div class="card-header border-bottom">
        <h6 class="m-0 text-capitalize font-weight-bold">campus requests accounts</h6>
      </div>
      <div class="card-body  pb-3">
        <table class="table table-hover table-bordered">
          <thead class="bg-light">
            <tr>
              <th>Name</th>
              <th>Email</th>
              <th>Phone Number</th>
              <th>Address</th>
              <th>Request at</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            @forelse($campusAccountRequest as $campus)
            <tr>
              <td>{{ $campus->name }}</td>
              <td>{{ $campus->email }}</td>
              <td>{{ $campus->phone_number }}</td>
              <td>{{ $campus->address }}</td>
              <td>{{ $campus->created_at->format('F d, Y h:m A') }}</td>
              <td><a class='btn btn-primary' href="{{ route('approved.campus.request', $campus->id) }}">Approve</a>
              <a class='btn btn-danger' href="{{ route('reject.campus.request', $campus->id) }}">Reject</a></td>
            </tr>
            @empty
            <td class='text-capitalize text-danger text-center' colspan='6'>no available account request</td>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<br>

<div class="row">
  <div class="col">
    <div class="card card-small rounded-0">
      <div class="card-header border-bottom">
        <h6 class="m-0 text-capitalize font-weight-bold">Campus Submitted Forms</h6>
      </div>
      <div class="card-body pb-3">
        @foreach($forms as $yearAndQuarter => $form)
        @php $year = explode('_', $yearAndQuarter)[0]; $quarter = explode('_', $yearAndQuarter)[1] @endphp
        <div class="alert alert-primary" role="alert">
          Administrator Submitted form in {{ $year }} - Quarter {{ $quarter }}
        </div>
        @foreach($form as $f)
        <h5 class='text-dark text-capitalize'>{{ $f->title }} {{ $f->created_at->format('F d, Y h:m A') }}</h5>
        <table class='table table-bordered table-hover' style='width:100%;'>
          <thead>
            <tr>
              <th>Campus Name</th>
              <th>Submitted at</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach($campus as $c)
            @if(!$c->forms->pluck('id')->isEmpty())
            @if(in_array($f->id, $c->forms->pluck('id')->toArray()))
            <tr>
              <td>{{ $c->name }}</td>
              <td class='font-weight-bold text-dark'>{{ $c->forms->where('id', $f->id)->first()->pivot->created_at->format('F d, Y h:m A') }}</td>
              <td class='text-center'><a class='btn btn-primary' href="{{ route('download.campus.submitted.form', [$f->link, $c]) }}">Download</a></td>
            </tr>
            @else
            {{-- IF THE CAMPUS HAVE A FORM SUBMIT BUT OTHER FORM --}}
            <tr>
              <td class='text-danger text-capitalize'>{{ $c->name }}</td>
              <td></td>
              <td></td>
            </tr>
            @endif
            @else
            {{-- IF THE CAMPUS NOT HAVE A FORM SUBMIT --}}
            <tr>
              <td class='text-danger text-capitalize'>{{ $c->name }}</td>
              <td></td>
              <td></td>
            </tr>
            @endif
            @endforeach
            <hr>
          </tbody>
        </table>
        @endforeach
        @endforeach
        <hr>
      </div>
    </div>
  </div>
</div>
<br>
<!-- End Default Light Table -->
@endsection