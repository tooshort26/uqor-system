@extends('admin.layouts.dashboard-template')
@section('page-small-title','Campus')
@section('page-title','Send SMS')
@section('content')
<div class="row">
  <div class="col">
    @include('templates.success')
    @include('templates.error')
    @include('templates.form-reminder')
    <div class="card card-small rounded-0">
      <div class="card-header border-bottom">
        <h6 class="m-0">Generate Report</h6>
      </div>
      <div class="card-body  pb-3">
        <form action="{{ route('report.store') }}" method="POST">
          @csrf
          <div class="form-group">
            <label>From date</label>
            <input type="date" name='from_date' class='form-control font-weight-bold'>
          </div>

          <div class="form-group">
            <label>To date</label>
            <input type="date" name='to_date' class='form-control font-weight-bold'>
          </div>
          
          <input type="submit" value="Generate Report" class='btn btn-primary font-weight-bold float-right'>
          <div class="clearfix"></div>
        </form>
      </div>
    </div>
  </div>
</div>
@push('page-scripts')
<script>
  
</script>
@endpush
@endsection