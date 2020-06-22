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
<form method="post" action="{{ url("email-user-group/insert") }}">
  {{ csrf_field() }}
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-sm-4">
                <label>Group Name:</label><span style="color:red">*</span>
                <input type="text" name="group_name" class="form-control" placeholder="Name Here" required="">
              </div>
              
            </div>
            {{-- <div class="row">
              
              <div class="col-sm-6 mt-3">
                <label>Role:</label>
                <select onchange="eventType(this)" class="form-control" name="role[]" multiple="" required="" style="height:100px">
                  <option disabled="" selected="" value="">Select Role</option>
                  @foreach( $role as $key => $r )
                    <option value="{{ $r->id }}">{{ $r->name }}</option>
                  @endforeach
                </select>
              </div>
            </div> --}}
            
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-8">
        <div class="card">
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-striped" id="UserTable">
                <thead class="thead-dark">
                  <tr>
                    <th><span style="visibility:hidden;">No.</span><input value="'.$u->id.'" name="users[]" type="checkbox" class="form-control" style="height:18px"></th>
                    <th>Role</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                  </tr>
                </thead>
              </table>
            </div>
            <button type="Submit" class="btn btn-dark mt-3">Submit</button>
          </div>
        </div>

      </div>
      <div class="col-4">
        <div class="card">
          <div class="card-body">
            <div>
              <label>Role:</label>
              <select class="form-control" name="role[]" required="" style="height: 100px" multiple="">
                @foreach( $role as $key => $r )
                  <option value="{{ $r->id }}">{{ $r->name }}</option>
                @endforeach
              </select>
            </div>
          </div>
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
   $('#UserTable').DataTable( {
               "processing": true,
               "serverSide": false,
               'datatype' : 'html',
               "ajax": "{{ url('email-user-group/create') }}",
       } );
 </script>
@endsection