@extends('layout.layout')
@section('title')
Create Membership Plane
@endsection
@section('css')

@endsection
@section('content')
<form method="post" action="{{ url("membership-plane/insert") }}" enctype="multipart/form-data">
  {{ csrf_field() }}
 <div class="container-fluid">
   <div class="row">
     <div class="col-sm-12">
       <div class="card">
         <div class="card-body">
           <div class="row">
             <div class="col-sm-4">
               <label>Roles:</label><span style="color:red">*</span>
               <select class="form-control" name="role" required="">
                 <option disabled="" value="" selected="">Select Role</option>
                 <option value="66">Investor</option>
                 <option value="67">Founder-Incubator</option>
                 <option value="68">Founder-Accelator</option>
               </select>
             </div>
             
             <div class="col-sm-4">
               <label>Membership Name:</label><span style="color:red">*</span>
               <input type="text" name="membership_name" class="form-control" placeholder="Membership Name" required="">
             </div>
             <div class="col-sm-4">
               <label>Durations(months):</label><span style="color:red">*</span>
               <input type="type" name="membership_duration" class="form-control" placeholder="Durations" required="">
             </div>

             <div class="col-sm-4 mt-3">
               <label>Cost(In GBP):</label><span style="color:red">*</span>
               <input onkeyup="ExchangeTo()" type="text" name="membership_cost" class="form-control" placeholder="Cost in GBP" required="">
             </div>


             <div class="col-sm-4 mt-3">
               <label>Exchange To:</label><span style="color:red">*</span>
               <select onchange ="ExchangeTo()" class="form-control" name="exchangeTo">
                 <option disabled="" value="" selected="">Exchange To</option>
                 <option>CAD</option>
                 <option>HKD</option>
                 <option>ISK</option>
                 <option>PHP</option>
                 <option>DKK</option>
                 <option>HUF</option>
                 <option>CZK</option>
                 <option>GBP</option>
                 <option>RON</option>
                 <option>SEK</option>
                 <option>IDR</option>
                 <option>INR</option>
                 <option>BRL</option>
                 <option>RUB</option>
                 <option>HRK</option>
                 <option>JPY</option>
                 <option>THB</option>
                 <option>CHF</option>
                 <option>EUR</option>
                 <option>MYR</option>
                 <option>BGN</option>
                 <option>TRY</option>
                 <option>CNY</option>
                 <option>NOK</option>
                 <option>NZD</option>
                 <option>ZAR</option>
                 <option>USD</option>
                 <option>MXN</option>
                 <option>SGD</option>
                 <option>AUD</option>
                 <option>ILS</option>
                 <option>KRW</option>
                 <option>PLN</option>
               </select>
             </div>

             <div class="col-sm-4 mt-5">
               <label id="exchanged"></label>
             </div>

             
           </div>
           <div class="row">
             <div class="col-sm-4 mt-3">
               <label>Description:</label>
               <textarea class="form-control" name="description"></textarea>
             </div>
           </div>
           <button type="Submit" class="btn btn-dark mt-3">Submit</button>
         </div>
       </div>
     </div>
   </div>
 </div>
</form>

@endsection
@section('jquery')
<script type="text/javascript">
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
          $('#exchanged').html(data+' '+val[data]*$('input[name="membership_cost"]').val());
        }
      });
    });
  }
  
</script>
 
@endsection