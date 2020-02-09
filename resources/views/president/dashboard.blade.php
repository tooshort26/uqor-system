@extends('president.layouts.dashboard-template')
@section('page-small-title','Dashboard')
@section('page-title','Overview')
@section('content')
 @include('templates.success')
  <div class="col-lg-12 col-md-auto col-sm-auto">
    <div class="card card-small rounded-0">
      <div class="card-header border-bottom">
        <h6 class="m-0 text-capitalize">Campuses Pending Forms</h6>
      </div>
      <div class="card-body pb-3 ">
        <table class='table table-bordered table-hover'>
          <thead>
            <tr>
              <th>Name</th>
              <th>Form title</th>
              <th>Form Description</th>
              <th class='text-center'>Deadline</th>
              <th>Year & Quarter</th>
              <th>Submitted At</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach($campusPendingForms as $campus)
              @foreach($campus->forms as $c)
              <tr>
                <td>{{ $campus->name }}</td>
                 <td>{{ $c->title }}</td>
                <td>{{ $c->description }}</td>
                <th class='text-danger text-center'>{{ $c->deadline->format('F d, Y h:m A') }}</th>
                <td class='text-center'>{{ $c->pivot->created_at->year }} - {{ $quarters[$c->pivot->created_at->quarter - 1] }} Quarter</td>
                <td class='text-center'>{{ $c->pivot->created_at->format('F d, Y h:m A') }}</td>
                <td class='text-center'>
                	<a href="{{ route('president-view.form', [$campus->id, $c->pivot->form_id]) }}" class='btn btn-success'>View</a>
                </td>
              </tr>
              @endforeach
            
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>


<br>
<div class="col-lg-12 col-md-auto col-sm-auto">
    <div class="card card-small rounded-0">
      <div class="card-header border-bottom">
        <h6 class="m-0 text-capitalize">Campuses Approved Forms</h6>
      </div>
      <div class="card-body pb-3 ">
        <table class='table table-bordered table-hover'>
          <thead>
            <tr>
              <th>Name</th>
              <th>Form title</th>
              <th>Form Description</th>
              <th class='text-center'>Deadline</th>
              <th>Year & Quarter</th>
              <th>Submitted At</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach($campusApprovedForms as $campus)
              @foreach($campus->forms as $c)
              <tr>
                <td>{{ $campus->name }}</td>
                <td>{{ $c->title }}</td>
                <td>{{ $c->description }}</td>
                <th class='text-danger text-center'>{{ $c->deadline->format('F d, Y h:m A') }}</th>
                <td class='text-center'>{{ $c->pivot->created_at->year }} - {{ $quarters[$c->pivot->created_at->quarter - 1] }}</td>
                <td class='text-center'>{{ $c->pivot->created_at->format('F d, Y h:m A') }}</td>
                <td class='text-center'>
                  <a href="{{ route('president-view.form', [$campus->id, $c->pivot->form_id]) }}" class='btn btn-success'>View</a>
                  <a href="{{ $c->pivot->link }}" class='btn btn-primary'>Download</a>
                </td>
              </tr>
              @endforeach
            
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection