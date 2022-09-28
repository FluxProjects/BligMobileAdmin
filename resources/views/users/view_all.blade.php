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
    @media (min-width: 992px){
      .modal-lg, .modal-xl {
          max-width: 1200px;
      }
    }
    .edit_membership{
      cursor: pointer;
    }
    .loader {
      border: 5px solid #e9ecef;
      border-radius: 50%;
      border-top: 5px solid #2a3142;
      width: 20px;
      height: 20px;
      -webkit-animation: spin 2s linear infinite; /* Safari */
      animation: spin 2s linear infinite;
    }

    /* Safari */
    @-webkit-keyframes spin {
      0% { -webkit-transform: rotate(0deg); }
      100% { -webkit-transform: rotate(360deg); }
    }

    @keyframes spin {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
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
                <table class="table table-striped" id="UserTable">
                  <thead class="thead-dark">
                    <tr>
                      <th>No.</th>
                      <th>Image</th>
                      <th>Role</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Phone</th>
                      <th>Address</th>
                      <th>Lat</th>
                      <th>Long</th>
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
<div class="modal" id="_user_model">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
{{--         <h4 class="modal-title">Modal Heading</h4> --}}
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body _user_model_body">
        
      </div>

    </div>
  </div>
</div>

@endsection
@section('jquery')
 <script type="text/javascript">
   $('#UserTable').DataTable( {
               "processing": true,
               "serverSide": false,
               'datatype' : 'html',
               "ajax": "{{ url('user/all') }}",
       } );
   var membership_plane='';
   var user_id='';
   var membership_plan_cost=0;
   var save_membershipChanges_data=0;
   function get_user_details(id) {
    membership_plane='';
     $.ajax({
       url: '{{ url("user/get") }}/'+id,
       type: 'get',
       dataType: 'json',
     })
     .done(function(resp) {
      var roles='';
      user_id=id
      

       $(resp.user._role._role_name).each(function(i, val) {
         roles+=val.name+', ';
       });

       $(resp.membership_plane).each(function(i, val) {
         membership_plane+='<option value="'+val.id+'-'+val.membership_name+'-'+val.membership_cost+'">'+val.membership_name+'</option>';
       });
       var assign_membership_plan=resp.assign_membership!=null ? resp.assign_membership._membership.membership_name : null;

       var assign_membership_plan_id=resp.assign_membership!=null ? resp.assign_membership._membership.id : null;

        $('._user_model_body').html('<div class="row"><div class="col-sm-3"><img class="img-thumbnail" width="100%" src="http://localhost/blig_web/storage/app/public/user_profile_images/'+resp.user.profile_pic+'"></div><div class="col-sm-9"><div class="row"><div class="col-sm-4 mb-3"><b>First Name</b>: '+resp.user.first_name+'</div><div class="col-sm-4 mb-3"><b>Last Name</b>: '+resp.user.last_name+'</div><div class="col-sm-4 mb-3"><b>Role</b>: '+roles+'</div><div class="col-sm-4 mb-3"><b>Email</b>: '+resp.user.email+'</div><div class="col-sm-4 mb-3"><b>Phone</b>: '+resp.user.contact_no+'</div><div class="col-sm-4 mb-3"><b>Address</b>: '+resp.user.address1+' '+resp.user.address2+'</div><div class="col-sm-4 mb-3"><b>Country</b>: '+( resp.user._country!=null ? resp.user._country.name : null )+'</div><div class="col-sm-4 mb-3"><b>State</b>: '+( resp.user._state!=null ? resp.user._state.name : null )+'</div><div class="col-sm-4 mb-3"><b>City</b>: '+( resp.user._city!=null ? resp.user._city.name : null )+'</div><div class="col-sm-4 mb-3"><b>Latitude</b>: '+resp.user.latitude+'</div><div class="col-sm-4 mb-3"><b>Longitude</b>: '+resp.user.longitude+'</div><div class="col-sm-4 membership_body"><b>Membership Plan</b>: '+assign_membership_plan+' <i onclick="Edit_membership()" class="edit_membership text-dark fas fa-pencil-alt"></i></div><div class="col-sm-4 mb-3 edit_m_p d-none"><b>Membership Cost</b>: <span class="membership_plan_cost"></span> GBP<input name="membership_cost" value="" type="hidden"></div><div class="col-sm-4 edit_m_p d-none"><b>Exchange To:</b></div><div class="col-sm-4 mt-3"></div><div class="col-sm-4 edit_m_p d-none" id="exchanged"><div class="loader"></div></div><div class="col-sm-4 edit_m_p d-none"> <select onchange="ExchangeTo()" class="form-control" name="_currency"><option disabled="" value="" selected="">Exchange To</option><option>CAD</option><option>HKD</option><option>ISK</option><option>PHP</option><option>DKK</option><option>HUF</option><option>CZK</option><option>GBP</option><option>RON</option><option>SEK</option><option>IDR</option><option>INR</option><option>BRL</option><option>RUB</option><option>HRK</option><option>JPY</option><option>THB</option><option>CHF</option><option>EUR</option><option>MYR</option><option>BGN</option><option>TRY</option><option>CNY</option><option>NOK</option><option>NZD</option><option>ZAR</option><option>USD</option><option>MXN</option><option>SGD</option><option>AUD</option><option>ILS</option><option>KRW</option><option>PLN</option> </select></div><div class="col-sm-4 edit_m_p d-none"> <button onclick="save_membership_plane()" class="btn btn-dark">Save <i class="fa fa-pencil-alt"></i></button></div></div></div></div>');

        // alert(assign_membership_plan_id);
        
        
        // $('#_membership_cost').val(resp.membership_plane.membership_cost);
     });
     
   }
   function save_membership_plane() {
      
      console.log(save_membershipChanges_data);
      $('.membership_body').html('<b>Membership Plan</b>: '+save_membershipChanges_data[1]+' <i onclick="Edit_membership()" class="edit_membership text-dark fas fa-pencil-alt"></i>');

      $('.edit_m_p').addClass('d-none');

      save_membershipChanges();
   }
  
   function Edit_membership() {
    $('.edit_m_p').removeClass('d-none');
      var membership_select='<select class="form-control" name="membership_plan"><option disabled="" value="" selected="">Select Plan</option>'+membership_plane+'</select>';
      $('.membership_body').html(membership_select);


      $.ajax({
        url: '{{ url('membership-plane/get') }}/'+user_id,
        type: 'get',
        dataType: 'json',
      })
      .done(function(resp) {

        $('select[name="exchangeTo"]').val(resp.currency).change();

         $('select[name="membership_plan"]').val(resp.membership_id+'-'+resp._membership.membership_name+'-'+resp._membership.membership_cost).change();
      });
   }
   function save_membershipChanges() {
    var data= $('select[name="membership_plan"]').val().split('-');
      save_membershipChanges_data=data;
      $('input[name="membership_cost"]').val(data[2]);
      $('.membership_plan_cost').html(data[2]);

     $.ajax({
       url: '{{ url('membership-plane/assign') }}',
       type: 'get',
       dataType: 'json',
       data: { 'membership_id':data[0], 'user_id':user_id, 'currency':$('select[name="_currency"]').val() }
     })
     .done(function(resp) {
        
     });
   }

   function ExchangeTo() {

     var data=$('select[name="exchangeTo"]').val();
     $.ajax({
       url: '{{ url("https://api.exchangeratesapi.io/latest?base=GBP") }}',
       type: 'GET',
       dataType: 'JSON',
     })
     .done(function(resp) {
       $(resp.rates).each(function(i, val) {

         if ( data!=undefined ) {
           setTimeout(function() {
              
               var exchanged_cost=val[data]*$('input[name="membership_cost"]').val();
              $('#exchanged').html($('input[name="membership_cost"]').val()+' GBP to '+ exchanged_cost.toFixed(2)+' '+data);

           },2500);
         }
       });
     });
   }
 </script>
@endsection