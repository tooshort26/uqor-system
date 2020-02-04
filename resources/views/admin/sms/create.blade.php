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
        <h6 class="m-0">Send SMS Form</h6>
      </div>
      <div class="card-body  pb-3">
        <form action="{{ route('sms.store') }}" method="POST" id='sendMessageForm'>
          @csrf
          <div class="form-group">
            <label>Phone Number</label>
            <input type="text" name='phone_numbers' class='form-control font-weight-bold' placeholder='Enter phone number' id='phoneNumbers'>
          </div>
          <div class="form-group">
            <label>Message</label>
            <textarea name="message" class='form-control font-weight-bold' placeholder='Enter your message here...' cols="30" rows="10"></textarea>
          </div>
          
          <input type="button" id='btnSendMessage' value="Send Message" class='btn btn-primary font-weight-bold float-right'>
          <div class="clearfix"></div>
        </form>
      </div>
    </div>
  </div>
</div>
@push('page-scripts')
<script>
  (function() {
    $('#phoneNumbers').val(window.sessionStorage.getItem('phone_numbers'));
  })();

  // When the user click the send message we need to clear the session for phone numbers first.
  // Then trigger the submit event for the form.
  $('#btnSendMessage').click(function (e) {
    e.preventDefault();
    // window.sessionStorage.clear();
    $('#sendMessageForm').trigger('submit');
  });
</script>
@endpush
@endsection