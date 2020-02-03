@extends('admin.layouts.dashboard-template')
@section('page-small-title','Campus')
@section('page-title','Send SMS')
@section('content')
<div class="row">
  <div class="col">
    @include('templates.success')
    @include('templates.error')
    <div class="card card-small rounded-0">
      <div class="card-header border-bottom">
        <h6 class="m-0">Send SMS Form</h6>
      </div>
      <div class="card-body  pb-3">
        <form action="{{ route('sms.store') }}" method="POST" >
          @csrf
          <div class="form-group">
            <label>Phone Number</label>
            <input type="text" name='phone_number' class='form-control font-weight-bold' placeholder='Enter phone number'>
          </div>
          <div class="form-group">
            <label>Message</label>
            <textarea name="message" class='form-control font-weight-bold' placeholder='Enter your message here...' cols="30" rows="10"></textarea>
          </div>
          
          <input type="submit" value="Send Message" class='btn btn-primary font-weight-bold float-right'>
          <div class="clearfix"></div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection