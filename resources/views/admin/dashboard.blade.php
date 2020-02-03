@extends('admin.layouts.dashboard-template')
@section('page-small-title','Dashboard')
@section('page-title','Overview')
@section('content')
 <!-- Default Light Table -->
 @include('templates.success')
 @include('templates.error')
 @if(Session::get('form_submission_review') == 'no_form')
 <div class="alert alert-danger text-white fade show mb-0" role="alert">
    <i class="fa fa-times mx-2"></i>
    <strong>Please upload a uniform form for this quarter.</strong>
    </div>
 @endif
 <br>
            <div class="row">
              <div class="col">
                <div class="card card-small rounded-0">
                  <div class="card-header border-bottom">
                    <h6 class="m-0 text-capitalize">campus requests accounts</h6>
                  </div>
                  <div class="card-body p-0 pb-3 text-center">
                    <table class="table table-hover">
                      <thead class="bg-light">
                        <tr>
                          <th>Name</th>
                          <th>Email</th>
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
	                      		<td>{{ $campus->address }}</td>
	                      		<td>{{ $campus->created_at->format('F d, Y h:m A') }}</td>
	                      		<td><a class='btn btn-primary' href="{{ route('approved.campus.request', $campus->id) }}">Approve</a>
	                      		<a class='btn btn-danger' href="{{ route('reject.campus.request', $campus->id) }}">Reject</a></td>
                          </tr>
	                      	@empty
	                      		<td class='text-capitalize text-danger' colspan='5'>no available account request</td>
                      		@endforelse
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <!-- End Default Light Table -->
@endsection
