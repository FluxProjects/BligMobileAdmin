@extends('layout.layout')
@section('title')
Answer
@endsection
@section('css')
  <style type="text/css">
    #onboarding_statusTable_length{
      float: left!important;
    }
    #onboarding_statusTable_filter,#onboarding_statusTable_paginate{
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
<form method="post" action="{{ url("onboarding-status/insert") }}" enctype="multipart/form-data">
  {{ csrf_field() }}
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-body">
              <div class="form-row">
                <div class="col-md-4 mb-3">
                  <label>User:</label>
                  <select onchange="change_user(this)" class="form-control" name="user">
                    <option disabled="" selected="">Select User</option>
                    @foreach( $user as $key => $u )
                      <option value="{{ $u->user_id }}">{{ $u->user_name->first_name=='' || $u->user_name->first_name==nul || $u->user_name->last_name=='' || $u->user_name->last_name==nul  ? $u->user_name->name : $u->user_name->first_name." ".$u->user_name->last_name, }}</option>
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
<div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped" id="onboarding_statusTable">
                  <thead class="thead-dark">
                    <tr>
                      <th>No.</th>
                      <th>User Name</th>
                      <th>Question</th>
                      <th>Answer</th>
                      <th>Avg Score</th>
                    </tr>
                  </thead>
                </table>
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
@section('jquery')
 <script type="text/javascript">

   function change_user(e) {
     
     var ansTable=$('#onboarding_statusTable').DataTable( {
                 "processing": true,
                 "serverSide": false,
                 'datatype' : 'html',
                 "destroy": true,
                 "ajax": {
                    "url" : "{{ url('answer/view') }}/{{$type}}",
                    "data": function ( d ) {
                            d.user_id = $(e).val();
                    }
                 },
         } );
   }
 </script>
@endsection