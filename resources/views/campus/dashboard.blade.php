@extends('campus.layouts.dashboard-template')
@section('page-small-title','Dashboard')
@section('page-title','Overview')
@section('content')
 @include('templates.success')
 @include('templates.error')
           <div class="row">
              <div class="col">
                <div class="card card-small rounded-0">
                  <div class="card-header border-bottom">
                    <h6 class="m-0 text-capitalize">Administrator Uploaded Forms</h6>
                  </div>
                  <div class="card-body p-0 pb-3 text-center">
                    <table class="table table-hover">
                      <thead class="bg-light">
                        <tr>
                          <th>Title</th>
                          <th>Description</th>
                          <th>Quarter</th>
                          <th>Date Uploaded</th>
                          <th>Deadline</th>
                          <th>Days Left</th>
                          <th>Status</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody id='table-row'>
                      		@forelse($forms as $form)
                          @php $hasSubmit = false @endphp
                      			<tr>
                      				<td class='text-capitalize'>{{ $form->title }}</td>
                      				<td class='text-capitalize'>{{ $form->description }}</td>
                      				<td>{{ $form->quarter }}</td>
                      				<td class='text-primary font-weight-bold'>{{ $form->created_at->format('F j, Y H:m A') }}</td>
                      				<td class='text-danger font-weight-bold'>{{ $form->deadline->format('F j, Y H:m A') }}</td>
                      				<td>
                                @if(!in_array($form->id, $campusSubmittedFormIds))
                                  @if($form->deadline->isPast())
                                    <span class="badge badge-danger">{{ $form->deadline->diffForHumans() }}</span>
                                  @else
                                    <span class="badge badge-primary">{{ $form->deadline->diffForHumans() }}</span>
                                  @endif
                                  <td><span class="badge badge-danger">Need to submit</span></td>
                                @else
                                @php 
                                  $index = array_search($form->id, $campusSubmittedFormIds);
                                  $hasSubmit = true;
                                @endphp
                                <span class="badge badge-primary">{{ $form->deadline->diffForHumans() }}</span>
                                <td><span class="badge badge-success">{{ $campusSubmittedFormStatus[$index] }}</span></td>
                                @endif
                      				</td>

                      				<td>
                                @if($hasSubmit)
                                  <a href="{{ route('campus-pending-forms.show', [$form]) }}" class='btn btn-success text-white font-weight-bold'>View</a>
                                  <a href="{{ Auth::user()->forms->where('id', $form->id)->first()->pivot->link }}" class='btn btn-primary'>Download</a>
                                  <a href="{{ route('campus-form.edit', $form) }}" class='btn btn-info'>Replace Submitted Form</a>
                                  @else
                                  <a href="{{ $form->link }}" class='btn btn-primary'>Download</a>
                                @endif
                      					
                      					@if(!$form->deadline->isPast() && !in_array($form->id, $campusSubmittedFormIds))
                      						<a href="{{ route('campus-form.edit', $form) }}" class='btn btn-success'>Submit Form</a>
                      					@endif
                      				</td>
                      			</tr>
                      			@empty
                      			<tr id="no-data-message">
                      				<td class='text-danger text-capitalize' colspan='8'>no available data</td>
                      			</tr>
                      		@endforelse
                      	
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <!-- End Default Light Table -->

@endsection

