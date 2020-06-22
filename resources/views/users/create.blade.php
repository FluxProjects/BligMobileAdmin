@extends('layout.layout')
@section('title')
Create New User
@endsection
@section('css')
 
@endsection
@section('content')
<form method="post" action="{{ url("user/insert") }}" enctype="multipart/form-data">
  {{ csrf_field() }}
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-body">
              <div class="form-row">
                <div class="col-md-4 mb-3">
                  <label for="validationDefault01">First name</label><span style="color:red">*</span><span style="color:red" class="v_error"></span>
                  <input class="alhpabet_validation form-control" id="validationDefault01" name="f_name" type="text" placeholder="First name" required="">
                </div>
                <div class="col-md-4 mb-3">
                  <label for="validationDefault02">Last name</label><span style="color:red">*</span><span style="color:red" class="v_error"></span>
                  <input class="alhpabet_validation form-control" id="validationDefault02" type="text" name="l_name" placeholder="Last name" required="">
                </div>
                <div class="col-md-4 mb-3">
                  <label for="validationDefaultRole">User Role</label><span style="color:red">*</span>
                  <div class="input-group">
                    <select class="custom-select" required="" name="role">
                      <option selected="" disabled="" value="">Select Role</option>
                      @foreach( $role as $key => $r )
                      <option value="{{ $r->id }}">{{ $r->name }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="col-md-4 mb-3">
                  <label for="validationDefaultEmail">Email</label><span style="color:red">*</span>
                  <div class="input-group">
                    <input class="form-control" id="validationDefaultEmail" name="email" type="email" placeholder="Email" aria-describedby="inputGroupPrepend2" required="">
                  </div>
                </div>
                <div class="col-md-4 mb-3">
                  <label for="validationDefaultEmail">Password</label><span style="color:red">*</span>
                  <div class="input-group">
                    <input class="form-control" name="password" type="password" placeholder="xxxxxx" aria-describedby="inputGroupPrepend2" required="">
                  </div>
                </div>
                <div class="col-md-4 mb-3">
                  <label for="validationDefaultphone">Phone</label><span style="color:red">*</span>
                  <div class="input-group">
                    <input class="phone_validation form-control" id="validationDefaultphone" name="phone" type="text" placeholder="Phone" aria-describedby="inputGroupPrepend2" required="">
                  </div>
                </div>
                <div class="col-md-4 ">
                  <label for="validationDefaultAddress">Address</label><span style="color:red">*</span>
                  <div class="input-group">
                    <input class="form-control" id="validationDefaultAddress" name="address" type="textarea" placeholder="Address" aria-describedby="inputGroupPrepend2" required="">
                  </div>
                </div>
        
                <div class="col-md-4 ">
                  <label for="validationDefault03">Country</label><span style="color:red">*</span>
                  <div class="form-group">
                    <select onchange="getState(this)" class="custom-select" required="" name="country">
                      <option selected="" disabled="" value="">Search Country</option>
                      @foreach( $country as $key => $c )
                        <option value="{{ $c->id }}">{{ $c->name }}</option>
                      @endforeach
                    </select>
                    <div class="invalid-feedback">Example invalid custom select feedback</div>
                  </div>
                </div>
                <div class="col-md-4 ">
                  <label for="validationDefault04">State</label><span style="color:red">*</span>
                  <div class="form-group">
                    <select onchange="getCity(this)"  class="custom-select" required="" name="state" id="_state">
                      <option selected="" disabled="" value="">Search State</option>
                    </select>
                    <div class="invalid-feedback">Example invalid custom select feedback</div>
                  </div>
                </div>
                <div class="col-md-4">
                  <label for="validationDefault05">City</label><span style="color:red">*</span>
                    <div class="form-group">
                      <select class="custom-select" required="" class="city" name="city" id="_city">
                        <option selected="" disabled="" value="">Search City</option>
                      </select>
                      <div class="invalid-feedback">Example invalid custom select feedback</div>
                    </div>
                </div>
                <div class="col-md-4">
                  <label for="validationDefaultLong">Longitude</label>
                  <span style="color:red" class="v_error"></span>
                  <div class="input-group">
                    <input class="numaic_validation form-control" id="validationDefaultLong" type="text" placeholder="Longitude" aria-describedby="inputGroupPrepend2" name="long">
                  </div>
                </div>
                <div class="col-md-4">
                  <label for="validationDefaultLat">Lattitude</label>
                  <span style="color:red" class="v_error"></span>
                  <div class="input-group">
                    <input class="numaic_validation form-control" id="validationDefaultLat" type="text" placeholder="Lattitude" aria-describedby="inputGroupPrepend2" name="lat">
                  </div>
                </div>
                <div class="custom-file col-md-4 col-12  mb-4 mt-3">
                <input class="custom-file-input " id="validatedCustomFile" type="file" name="file">
                <label class="custom-file-label" for="validatedCustomFile">Upload Image...</label>
                <div class="invalid-feedback"></div>
              </div>
              </div>
             
              <button class="btn btn-dark" type="submit">Submit</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>

@endsection
@section('jquery')
 <script type="text/javascript">
   function getState(e) {
     $.ajax({
       url: '{{ url("get-state") }}/'+$(e).val(),
       type: 'get',
       dataType: 'json',
     })
     .done(function(resp) {
        var opt='<option selected="" disabled="" value="">Search State</option>';
        $(resp).each(function(i,val) {
          opt+='<option value="'+val.id+'">'+val.name+'</option>'
        });
        $('#_state').html(opt);
       console.log(resp);
     })
     .fail(function() {
       console.log("error");
     });
     
   }
   function getCity(e) {
     $.ajax({
       url: '{{ url("get-city") }}/'+$(e).val(),
       type: 'get',
       dataType: 'json',
     })
     .done(function(resp) {
        var opt='<option selected="" disabled="" value="">Search City</option>';
        $(resp).each(function(i,val) {
          opt+='<option value="'+val.id+'">'+val.name+'</option>'
        });
        $('#_city').html(opt);
       console.log(resp);
     })
     .fail(function() {
       console.log("error");
     });
     
   }
   // ============================= VALIDATION ===============================
   // ALPHABETS VALIDATIONS
   $(".alhpabet_validation").keypress(function (e) {
       var keyCode = e.keyCode || e.which;
       $(".v_error").html("");

       //Regex for Valid Characters i.e. Alphabets.
       var regex = /^[A-Za-z ]+$/;

       //Validate TextBox value against the Regex.
       var isValid = regex.test(String.fromCharCode(keyCode));
       if (!isValid) {
        $(this).parents('div').children('.v_error').html("Only Alphabets allowed.")
       }

       return isValid;
   });
   // NUMARIC VALIDATIONS
   $(".numaic_validation").keypress(function (e) {
       var keyCode = e.keyCode || e.which;
       $(".v_error").html("");

       //Regex for Valid Characters i.e. Alphabets.
       var regex = /^[0-9. ]+$/;

       //Validate TextBox value against the Regex.
       var isValid = regex.test(String.fromCharCode(keyCode));
       if (!isValid) {
        $(this).parents('div').children('.v_error').html("Only Numaric allowed.")
       }

       return isValid;
   });
   // PHONE# VALIDATIONS
   var phone_validation=''
   $(".phone_validation").keyup(function (e) {
       var keyCode = e.keyCode || e.which;
       if( $(this).val().charAt(0)!='+' ){
          $(this).val('+');
       }

       if ( $(this).val().length > 13 ) {
        $(this).val(phone_validation);
       }else{
        phone_validation=$(this).val();
       }
       
   });
   
 </script>
@endsection