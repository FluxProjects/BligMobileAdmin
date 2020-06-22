@extends('layout.layout')
@section('title')
Create Event
@endsection
@section('css')
 <style type="text/css">
   #UserTable_length{
     float: left!important;
   }
   #UserTable_filter,#UserTable_paginate{
     float: right!important;
   }
   .dataTables_wrapper .dataTables_paginate .paginate_button {
       padding: 3px 9px!important;
       /* width: 47px; */
   }
   .dataTables_wrapper .dataTables_paginate .paginate_button.current, .dataTables_wrapper .dataTables_paginate .paginate_button:active{
     background: #F59500!important;
     cursor: pointer!important;
   }
   .paginate_button {
     cursor: pointer!important;
   }
 </style>
@endsection
@section('content')
<form method="post" action="{{ url("email-temp/insert") }}">
  {{ csrf_field() }}
  <div class="container-fluid">
    <div class="alert alert-warning" style="border-left: 5px solid #f59500">
      <h4>Available Tags:</h4>
      <p> {event_name}, {event_date}, {event_time}, {event_type}, {mode}, {mode_id}, {venue}, {current_date}, {business_logo}, {contact_name}, {contact_email}, {contact_phone}</p>
    </div>
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-md-4 mb-3">
                <label for="validationDefault01">Template Name</label><span style="color:red">*</span><span style="color:red" class="v_error"></span>
                <input class="alhpabet_validation form-control" id="validationDefault01" name="temp_name" type="text" placeholder="Template name" required="">
              </div>

              <div class="col-md-4 mb-3">
                <label for="validationDefault01">Subject</label><span style="color:red">*</span><span style="color:red" class="v_error"></span>
                <input class="alhpabet_validation form-control" id="validationDefault01" name="subject" type="text" placeholder="Subject" required="">
              </div>

              <div class="col-md-4 mb-3">
                <label for="validationDefault01">Events</label><span style="color:red">*</span><span style="color:red" class="v_error"></span>
                <select class="custom-select" name="_event">
                  <option selected="" disabled="" value="">Select Event</option>
                  @foreach( $event as $key => $e )
                  <option value="{{ $e->id }}">{{ $e->name }}</option>
                  @endforeach
                </select>
              </div>

              <div class="col-12 mb-3">
                <label>Email Body:</label>
                <textarea name="_temp"></textarea>
              </div>
            </div>
            <button class="btn btn-dark" type="submit">Submit</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>

@endsection
@section('jquery')
 <script>
  $('._online').hide();
  $('._offline').hide();
   function eventType(e) {
     if ($(e).val()==0){
        $('._online').show();
        $('._offline').hide();
     }else{
        $('._online').hide();
        $('._offline').show();
     }
   }
   CKEDITOR.replace( '_temp' );
   
 </script>
@endsection