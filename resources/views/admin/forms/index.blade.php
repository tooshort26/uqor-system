@extends('admin.layouts.dashboard-template')
@section('page-small-title','Dashboard')
@section('page-title','Overview')
@section('content')
@include('templates.form-reminder')
            <div class="row">
              <div class="col">
                <div class="card card-small rounded-0">
                  <div class="card-header border-bottom">

                    <h6 class="m-0 text-capitalize">Forms</h6>
                  </div>

                  <div class="card-body pb-3 ">
                      <div class="float-right">
                        <a class="mb-2 btn btn-primary btn-sm" href="{{ route('forms.create') }}"><span>Upload New Form</span></a>
                      </div>
                      @foreach($forms as $yearAndQuarter => $form)
                      @php $year = explode('_', $yearAndQuarter)[0]; $quarter = explode('_', $yearAndQuarter)[1] @endphp
                      <h5>Year {{ $year }} - Quarter {{ $quarter }}</h5>
                      <table class='table table-bordered table-hover'>
                            <thead>
                              <th>Title</th>
                              <th>Description</th>
                              <th>Quarter</th>
                              <th>Uploaded At</th>
                              <th class='text-center'>Actions</th>
                            </thead>
                            <tbody>
                        @foreach($form as $f)
                             <tr>
                              <td>{{ $f->title }}</td>
                              <td>{{ $f->description }}</td>
                              <td class='text-center'>{{ $f->quarter }}</td>
                              <td class='text-center'>{{ $f->created_at->format('F d,Y h:m A') }}</td>
                              <td class='text-center'><a class='btn btn-success' href="{{ $f->link }}">Download</a></td>
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
