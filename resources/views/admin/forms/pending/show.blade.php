@extends('admin.layouts.dashboard-template')
@section('page-small-title','Dashboard')
@section('page-title','Pending Forms')
@section('content')
@include('templates.form-reminder')
<div class="row">
  <div class="col">
    <div class="card card-small rounded-0">
      <div class="card-header border-bottom">
        <h6 class="m-0 text-capitalize">{{ $campusWithForm->name }} Pending Form {{ $campusWithForm->forms->first()->title }}</h6>
      </div>
      <div class="card-body pb-3 ">
        <iframe style="border:none" src="https://docs.google.com/viewer?url={{URL::asset('campus_forms/' . md5($campusWithForm->name) .'_'. $campusWithForm->forms->first()->link )}}&embedded=true" width="100%" height="1000px"  ></iframe>
        <br>
        <div class="form-group">
          <br>

          <ul class="list-group" id='comment-box'>
          <label class='font-weight-bold'>Comments: </label>
             @foreach($campusWithForm->forms->first()->comments as $comment)
              <li class="rounded-0 list-group-item list-group-item-warning font-weight-bold text-dark">
                  <span>{{ $comment->body }}</span>
                  <br>
                  <small class='ml-5 font-weight-bold text-right'>{{ $comment->created_at->diffForHumans() }}</small>
              </li>
              <br>
             @endforeach
          </ul>
          <br>
          <textarea class='form-control font-weight-bold' id="body" cols="30" rows="10" placeholder='Add comment to this form'></textarea>
          <div class="float-right">
            <input type="button" value='Add comment' class='btn btn-primary mt-3' id='btnAddCommentToForm'>
          </div>
          <div class="clearfix"></div>
        </div>
      </div>
      <br>
    </div>
  </div>
</div>
@push('page-scripts')
  <script>
    $('#btnAddCommentToForm').click(function (e) {
      let route = "{{route('pending-forms.add-comment', $formId)}}";
      let commentText = $('#body').val();
      $.ajax({
        type : 'POST', 
        url : route,
        data: { comment: commentText },
        success : function (response) {
          if (response.success) {
              $('#comment-box').append(`
                   <li class="rounded-0 list-group-item list-group-item-warning font-weight-bold text-dark">
                        <span>${response.comment}</span>
                        <br>
                         <small class='ml-5 font-weight-bold text-right'>${response.comment_at}</small>
                    </li>
              `);
              $('#body').val('');
          } else {
            alert('Oopps! there something wrong please refresh page and try to add new comment again.')
          }
        }
      });
    });
  </script>  

@endpush
@endsection