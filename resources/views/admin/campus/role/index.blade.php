@extends('admin.layouts.dashboard-template')
@section('page-small-title','Campus Roles')
@section('page-title','List of all registered role')
@section('content')
@include('templates.success')
@include('templates.form-reminder')
            <div class="row">
              <div class="col">
                <div class="card card-small rounded-0">
                  <div class="card-header border-bottom">
                    <a href="{{ route('role.create') }}" class="btn btn-primary" style="float:right;">
                      Add Role
                    </a>
                    <h6 class="m-0">
                      List of all registered role for campus
                    </h6>
                  </div>
                  <div class="card-body pb-3">
                    <table class="table table-hover table-bordered">
                      <thead>
                        <tr>
                          <th>Name</th>
                          <th>Created At</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                      	    @forelse($roles as $role)
                      	    <tr>
	                      		<td>{{ $role->name }}</td>
	                      		<td>{{ $role->created_at->format('F d, Y h:m A') }}</td>
	                      		<td class='text-center'>
                                    <a class='btn btn-primary' href="{{ route('role.edit', $role->id) }}">Edit</a>
                                    <a class='btn btn-danger' href="#" onclick="event.preventDefault(); document.getElementById('delete-form{{ $role->id }}').submit();" title="Delete">Delete</a>
                                    
                                    <form id="delete-form{{ $role->id }}" action="{{ route('role.destroy', $role->id) }}" method="POST">
                                      @csrf
                                      <input name="_method" type="hidden" value="DELETE">
                                    </form>
	                      	    </td>
                            </tr>
	                      	@empty
	                      		<td class='text-capitalize text-danger' colspan='3'>no record found</td>
                      		@endforelse
                     
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <!-- End Default Light Table -->
@endsection
