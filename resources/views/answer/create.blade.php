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
                  <label>Service Sector:</label>
                  <select onchange="filter(this)" class="form-control" id="ss">
                    <option disabled="" selected="">Select Service Sector</option>
                    @foreach( $ss as $key => $s )
                      <option value="{{ $s->id }}">{{ $s->ss_title }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="col-md-4 mb-3">
                  <label>User:</label>
                  <select onchange="filter(this)" class="form-control" id="user">
                    <option disabled="" selected="">Select User</option>
                    @foreach( $user as $key => $u )
                      <option value="{{ $u->user_id }}">
                        {{ $u->user_name->first_name=='' || $u->user_name->first_name==null || $u->user_name->last_name=='' || $u->user_name->last_name==null  ? $u->user_name->name : $u->user_name->first_name." ".$u->user_name->last_name, }}
                      </option>
                    @endforeach
                  </select>
                </div>
                
                <div class="col-md-4 mb-3">
                  <label>Onboarding Status:</label>
                  <select onchange="filter(this)" class="form-control" id="status">
                    <option disabled="" selected="">Status</option>
                    @foreach( $status as $key => $s )
                      <option value="{{ $s->id }}">{{ $s->status }}</option>
                    @endforeach
                  </select>
                </div>
                {{-- <div class="col-md-4 mb-3">
                  <label>Company Name:</label>
                  <input type="text" name="" class="form-control" id="company_name" onkeyup="filter(this)" >

                </div> --}}
                <div class="col-md-4 mb-3">
                  <label>Email:</label>
                  <input type="text" name="" class="form-control" id="email" onkeyup="filter(this)">
                </div>
                <div class="col-md-4 mb-3">
                  <label>Mobile:</label>
                  <input type="text" name="" class="form-control" placeholder="+" id="mobile" onkeyup="filter(this)">
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
                      <th>User Name</th>
                      <th>Email</th>
                      <th>Contact#</th>
                      <th>Question</th>
                      <th>Answer</th>
                      <th>Score</th>
                      {{-- <th>Action</th> --}}
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
  
   
   function submit_score(e,user_id,question_id,key) {
      $.ajax({
        url: '{{ url('answer/insert') }}',
        type: 'get',
        dataType: 'json',
        data: { 
          'data': $(e).val(), 
          'user_id': user_id, 
          'question_id': question_id,
          'disc': $('.disc'+key).val()
        },
      })
      .done(function(resp) {
        alert(resp);
        if ( resp=='create' ) {
          salert('success','Added successfully');
        }else{
          salert('success','Updated successfully');
        }
      })
      .fail(function() {
        console.log("error");
      }); 
   }

   function submit_disc(e,user_id,question_id,key) {
      $.ajax({
        url: '{{ url('answer/insert') }}',
        type: 'get',
        dataType: 'json',
        data: { 
          'disc': $(e).val(), 
          'user_id': user_id, 
          'question_id': question_id,
          'data': $('.score'+key).val()
        },
      })
      .done(function(resp) {
        if ( resp=='create' ) {
          salert('success','Added successfully');
        }else{
          salert('success','Updated successfully');
        }
      })
      .fail(function() {
        console.log("error");
      });
   }

   function filter(e) {

     var ansTable=$('#onboarding_statusTable').DataTable( {
                 "processing": true,
                 "serverSide": false,
                 'datatype' : 'html',
                 "destroy": true,
                 "ajax": {
                    "url" : "{{ url('answer/all') }}/{{$type}}",
                    "data": function ( d ) {

                            d.user_id = $('#user').val();
                            d.ss= $('#ss').val();
                            d.status= $('#status').val();
                            // d.company_name= $('#company_name').val();
                            d.email= $('#email').val();
                            d.mobile= $('#mobile').val();

                            
                            
                    }
                 },
         } );
   }
 </script>
@endsection