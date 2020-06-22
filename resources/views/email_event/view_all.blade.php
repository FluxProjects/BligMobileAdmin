@extends('layout.layout')
@section('title')
View Event
@endsection
@section('css')
  <style type="text/css">
    #RoleTable_length{
      float: left!important;
    }
    #RoleTable_filter,#RoleTable_paginate{
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
<form method="post" action="{{ url("role/insert") }}">
  {{ csrf_field() }}
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
        
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-striped" id="RoleTable">
                <thead class="thead-dark">
                  <tr>
                    <th>No.</th>
                    <th>Event Name</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Event Type</th>
                    <th>Desc.</th>
                    <th>Mode ID</th>
                    <th>Created_at</th>
                    <th>Action</th>
                  </tr>
                </thead>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>

@endsection
@section('jquery')
  <script type="text/javascript">
    $('#RoleTable').DataTable( {
                "processing": true,
                "serverSide": false,
                'datatype' : 'html',
                "ajax": "{{ url('email-event/all') }}",
        } );
  </script>
@endsection