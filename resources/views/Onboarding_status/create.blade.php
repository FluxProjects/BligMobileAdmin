@extends('layout.layout')
@section('title')
Create New Status
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
                  <label for="validationDefault01">Status name</label>
                  <input class="form-control" id="validationDefault01" name="onboarding_status" type="text" placeholder="Onboarding status" required="">
                </div>
              </div>
             
              <button class="btn btn-dark" type="submit">Submit</button>
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
                      <th>Onboarding Status</th>
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
@endsection
@section('jquery')
 <script type="text/javascript">
   $('#onboarding_statusTable').DataTable( {
               "processing": true,
               "serverSide": false,
               'datatype' : 'html',
               "ajax": "{{ url('onboarding-status/all') }}",
       } );
 </script>
@endsection