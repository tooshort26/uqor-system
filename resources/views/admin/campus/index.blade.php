@extends('admin.layouts.dashboard-template')
@section('page-small-title','Campus')
@section('page-title','List of all registered campus')
@section('content')
            <div class="row">
              <div class="col">
                <div class="card card-small rounded-0">
                  <div class="card-header border-bottom">
                    <h6 class="m-0">List of all registered campus</h6>
                  </div>
                  <div class="card-body p-0 pb-3 text-center">
                    <table class="table table-hover">
                      <thead class="bg-light">
                        <tr>
                          <th>Name</th>
                          <th>Email</th>
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
	                      		<td>{{ $campus->address }}</td>
	                      		<td>{{ $campus->created_at->format('F d, Y h:m A') }}</td>
                            <td>{{ $campus->updated_at->format('F d, Y h:m A') }}</td>
	                      		<td><a class='btn btn-success' href="{{ route('campus.show', $campus->id) }}">View</a>
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
