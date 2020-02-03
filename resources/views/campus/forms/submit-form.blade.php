@extends('campus.layouts.dashboard-template')
@prepend('page-css')
<link href="https://transloadit.edgly.net/releases/uppy/v1.8.0/uppy.min.css" rel="stylesheet">
@endprepend
@section('page-small-title','Forms')
@section('page-title','Submit form for ' . $campus_form->title)
@section('content')
 @include('templates.success')
 @include('templates.error')
 <div class="card card-small mb-4 rounded-0">
  <div class="card-header border-bottom">
    <h6 class="m-0">Form</h6>
  </div>
  <div class="card-body p-3 pb-3">
    <form action="{{ route('campus-form.update', $campus_form->id) }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')
      <div class="form-group">
        <label>Title</label>
        <input type="text" name='title' class='form-control font-weight-bold' readonly placeholder="Enter the title of the form" value="{{ $campus_form->title }}">  
      </div>

      <div class="form-group">
        <label>Description</label>
        <textarea name="description" class='form-control font-weight-bold' readonly placeholder='Enter the description of the form' cols="30" rows="10">{{ $campus_form->description }}</textarea>
      </div>

      <div class="form-group">
        <label>Deadline <u class='text-danger font-weight-bold'>{{ $campus_form->deadline->format('F j, Y H:m A') }}</u> to : </label>
        <input type="text" name='deadline' readonly class='form-control font-weight-bold' value="{{ $campus_form->deadline->format('m/d/Y') }}">  
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
  let endPoint = "{{ route('campus-form-upload', [$campus_form->link]) }}"
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
