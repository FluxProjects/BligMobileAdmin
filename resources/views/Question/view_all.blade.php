@extends('layout.layout')
@section('title')
Create New User
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
<form method="post" action="{{ url("user/insert") }}" enctype="multipart/form-data">
  {{ csrf_field() }}
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped" id="UserTable" style="white-space: nowrap;">
                  <thead class="thead-dark">
                    <tr>
                      <th>No.</th>
                      <th>Question Description</th>
                      <th>Type</th>
                      <th>Category</th>
                      <th>Multi Inputs</th>
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
   $('#UserTable').DataTable( {
               "processing": true,
               "serverSide": false,
               'datatype' : 'html',
               "ajax": "{{ url('Question/all/') }}/{{ $type }}",
       } );
 </script>
@endsection