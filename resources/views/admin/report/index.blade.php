@extends('admin.layouts.dashboard-template')
@section('page-small-title','Report')
@section('page-title','Campus Submit Forms Report')
@section('content')
@include('templates.form-reminder')
<div class="row">
  <div class="col">
    <div class="card card-small rounded-0">
      <div class="card-header border-bottom">
        <h6 class="m-0">Reports</h6>
      </div>
      <div class="card-body pb-3">
        @foreach($forms as $yearAndQuarter => $form)
        @php $year = explode('_', $yearAndQuarter)[0]; $quarter = explode('_', $yearAndQuarter)[1] @endphp
        <div class="alert alert-primary" role="alert">
          Administrator Submitted form in {{ $year }} - Quarter {{ $quarter }}
        </div>
        @foreach($form as $f)
          <h5 class='text-dark text-capitalize'>{{ $f->title }} {{ $f->created_at->format('F d, Y h:m A') }}</h5>
          <table class='table table-bordered table-hover'>
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
        <br>
        @endforeach
      </div>
    </div>
  </div>
</div>
<!-- End Default Light Table -->
@endsection