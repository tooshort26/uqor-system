@extends('admin.layouts.dashboard-template')
@section('page-small-title','Campus')
@section('page-title','List of all registered campus')
@section('content')
@include('templates.form-reminder')
            <div class="row">
              <div class="col">
                <div class="card card-small rounded-0">
                  <div class="card-header border-bottom">
                    <h6 class="m-0">List of all registered campus</h6>
                  </div>
                  <div class="card-body pb-3">
                    <table class="table table-hover table-bordered">
                      <thead>
                        <tr>
                          <th>Name</th>
                          <th>Email</th>
                          <th>Phone Number</th>
                          <th>Address</th>
                          <th>Request at</th>
                          <th>Approved at</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                      		@forelse($campuses as $campus)
                      	 <tr>
	                      		<td>{{ $campus->name }}</td>
	                      		<td>{{ $campus->email }}</td>
                            <td>{{ $campus->phone_number }}</td>
	                      		<td>{{ $campus->address }}</td>
	                      		<td>{{ $campus->created_at->format('F d, Y h:m A') }}</td>
                            <td>{{ $campus->updated_at->format('F d, Y h:m A') }}</td>
	                      		<td class='text-center'><a class='btn btn-success' href="{{ route('campus.show', $campus->id) }}">View</a>
	                      		</td>
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
