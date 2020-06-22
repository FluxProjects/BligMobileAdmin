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
<form method="post" action="{{ url("assign-email/insert") }}">
  {{ csrf_field() }}
  <div class="container-fluid">

    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-md-4 mb-3">
                <label for="validationDefault01">Template Name</label><span style="color:red">*</span><span style="color:red" class="v_error"></span>
                <select name="templete" class="form-control">
                  <option disabled="" value="">Select Templete</option>
                  @foreach($event_temp as $key => $e)
                  <option value="{{ $e->id }}">{{ $e->name }}</option>
                  @endforeach
                </select>
              </div>

              <div class="col-md-4 mb-3">
                <label for="validationDefault01">User Group</label><span style="color:red">*</span><span style="color:red" class="v_error"></span>
                <select name="user_group" class="form-control">
                  <option disabled="" value="">Select Group</option>
                  @foreach($group as $key => $g)
                  <option value="{{ $g->id }}">{{ $g->group_name }}</option>
                  @endforeach
                </select>
              </div>

              <div class="col-md-4 mb-3">
                <label for="validationDefault01">Trigger</label><span style="color:red">*</span><span style="color:red" class="v_error"></span>
                <select name="trigger" class="form-control">
                  <option disabled="" value="">Select Trigger</option>
                  <option value="_0">New Registration</option>
                  <option value="_1">Forget Password</option>
                  <option value="_2">On Boarding status</option>
                  <option value="_3">Membership Plan selection</option>
                  <option value="_4">Profile Update</option>
                </select>
              </div>
              

              
            </div>
            <button class="btn btn-dark" type="submit">Assign</button>
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