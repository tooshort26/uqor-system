@extends('admin.layouts.dashboard-template')
@section('page-small-title','Campus')
@section('page-title','Send Email')
@section('content')
@include('templates.form-reminder')
            <div class="row">
              <div class="col">
                <div class="card card-small rounded-0">
                  <div class="card-header border-bottom">
                    <h6 class="m-0">List of all registered campus</h6>
                  </div>
                  <div class="card-body pb-3">
                    <div class="float-right">
                      <button class='btn btn-primary' disabled="true" id='btnSendMessageToAllMark'>Send email to all mark</button>
                    </div>
                    <div class="clearfix"></div>
                    <br>
                    <table class="table table-hover table-bordered">
                      <thead class="bg-light">
                        <tr>
                          <th>Mark</th>
                          <th>Name</th>
                          <th>Email</th>
                          <th>Phone Number</th>
                          <th>Address</th>
                        </tr>
                      </thead>
                      <tbody>
                      		@forelse($campuses as $campus)
                      	 <tr>
                            <td class='mark-cell text-center'>
                              <input class='mark-checkbox' type="checkbox" name="send" id='mark_{{$campus->id}}' data-email="{{$campus->email }}">
                            </td>
	                      		<td>{{ $campus->name }}</td>
	                      		<td>{{ $campus->email }}</td>
                            <td>{{ $campus->phone_number }}</td>
	                      		<td>{{ $campus->address }}</td>
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
  @push('page-scripts')
    <script>
      // Clear the phone numbers first in the session storage.
      (function () {
        window.sessionStorage.clear();
      })();
      // function for removing an data in array by value.
      Array.prototype.remove = function() {
            var what, a = arguments, L = a.length, ax;
            while (L && this.length) {
                what = a[--L];
                while ((ax = this.indexOf(what)) !== -1) {
                    this.splice(ax, 1);
                }
            }
            return this;
        };

      // This method is to to fix bug when the user hit the back button if she/he is from the sms create form
      $(document).ready(function(){
         $('input:checkbox').prop('checked', false);
      }); 

      

      let emailAddress = [];

      $('.mark-checkbox').click(function () {
        $(this).parent().trigger('click');
      });
      $('.mark-cell').click(function (e) {
          let checkBox = $(this).children()[0];
          let campusEmail = $(checkBox).attr('data-email');
          // The checkbox is already checked mark as unchecked
          if ($(checkBox).prop('checked')) {
              $(checkBox).prop('checked', false);
              emailAddress.remove(campusEmail);
          } else {
              $(checkBox).prop('checked', true);
              emailAddress.push(campusEmail);
          }

          // Disabled/Enabled Button if there's a checked checkbox
          if (emailAddress.length != 0) {
            $('#btnSendMessageToAllMark').prop('disabled', false);
          } else {
            $('#btnSendMessageToAllMark').prop('disabled', true);
          }

      });

      $('#btnSendMessageToAllMark').click(function (e) {
          window.sessionStorage.setItem('emails', emailAddress);
          window.location.href = '{{ route('email.create') }}';
      });
    </script>
  @endpush
@endsection
