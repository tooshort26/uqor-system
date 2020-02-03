@extends('admin.layouts.dashboard-template')
@prepend('page-css')
<link href="https://transloadit.edgly.net/releases/uppy/v1.8.0/uppy.min.css" rel="stylesheet">
@endprepend
@section('page-small-title','Forms')
@section('page-title','Upload form for ' . $currentQuarter)
@section('content')
 @include('templates.success')
 @include('templates.error')
 <div class="card card-small mb-4 rounded-0">
  <div class="card-header border-bottom">
    <h6 class="m-0">Form</h6>
  </div>
  <div class="card-body p-3 pb-3">
    <form action="{{ route('forms.store') }}" method="POST" enctype="multipart/form-data">
      @csrf

  
      <div class="form-group">
        <label>Title</label>
        <input type="text" name='title' class='form-control font-weight-bold' placeholder="Enter the title of the form">  
      </div>

      <div class="form-group">
        <label>Description</label>
        <textarea name="description" class='form-control font-weight-bold' placeholder='Enter the description of the form' cols="30" rows="10"></textarea>
      </div>

      <div class="form-group">
        <label>Deadline <u class='font-weight-bold'>{{ \Carbon\Carbon::now()->format('F d, Y') }}</u> to : </label>
        <input type="date" name='deadline' class='form-control font-weight-bold' min="{{ Carbon\Carbon::now()->addDay(1)->format('Y-m-d') }}">  
      </div>

      <div class="form-group">
        <div id="drag-drop-area"></div>
      </div>

      <div class="text-right">
          <input type="submit" value="Submit form" class='btn btn-primary'>
      </div>

    </form>
  </div>
</div>
@push('page-scripts')
<script src="https://transloadit.edgly.net/releases/uppy/v1.8.0/uppy.min.js"></script>
<script>
  let endPoint = "{{ route('upload.form') }}"
  var uppy = Uppy.Core()
      .use(Uppy.Dashboard, {
          inline: true,
          target: '#drag-drop-area',
          width :'auto'
      })
      .use(Uppy.XHRUpload, {
          endpoint: endPoint,
          'X-CSRF-TOKEN' : " {{csrf_token()}} "
      });
</script>
@endpush
@endsection
