@extends('admin.layouts.dashboard-template')
@section('page-small-title','Dashboard')
@section('page-title','Pending Forms')
@section('content')
@include('templates.form-reminder')
<div class="row">
  <div class="col">
    <div class="card card-small rounded-0">
      <div class="card-header border-bottom">
        <h6 class="m-0 text-capitalize">Campuses Pending Forms</h6>
      </div>
      <div class="card-body pb-3 ">
        <table class='table table-bordered table-hover'>
          <thead>
            <tr>
              <th>Name</th>
              <th>Year & Quarter</th>
              <th>Submitted At</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach($campuses as $campus)
              @foreach($campus->forms as $c)
              <tr>
                <td>{{ $campus->name }}</td>
                <td class='text-center'>{{ $c->pivot->created_at->year }} - {{ $quarters[$c->pivot->created_at->quarter - 1] }} Quarter</td>
                <td class='text-center'>{{ $c->pivot->created_at->format('F d, Y h:m A') }}</td>
                <td class='text-center'>
                  <a href="/admin/pending/forms/{{$campus->id}}/{{ $c->pivot->form_id }}" class='btn btn-success'>View</a>
                  <a href="" class='btn btn-primary'>Approved</a>
                </td>
              </tr>
              @endforeach
            
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection