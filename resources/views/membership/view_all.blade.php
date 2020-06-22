@extends('layout.layout')
@section('title')
Membership  /  All
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

<div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped" id="onboarding_statusTable">
                  <thead class="thead-dark" style="white-space: nowrap!important;">
                    <tr>
                      <th>No.</th>
                      <th>Type</th>
                      <th>Group Type</th>
                      <th>Membership Type</th>
                      <th>Cost</th>
                      <th>Duration</th>
                      <th>Description</th>
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
               "ajax": "{{ url('membership-plane/all') }}",
       } );

   function getUser(e) {
    alert(1);
    $('#_user').html('<option disabled="" selected="">Select User</option>');
    $.ajax({
      url: '{{ url("answer/get-user") }}/'+$(e).val(),
      type: 'get',
      dataType: 'json',

    })
    .done(function(resp) {
      var option='';
      $(resp).each(function(i, val) {
          option+='<option value="'+val.id+'">'+val.category+'</option>';
      });
        $('#_user').html(option);
    })
    .fail(function() {
      console.log("error");
    })
    
   }
 </script>
@endsection