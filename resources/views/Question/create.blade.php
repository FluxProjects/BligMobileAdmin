@extends('layout.layout')
@section('title')
Create Question Category
@endsection
@section('css')
 
@endsection
@section('content')
<form method="post" action="{{ url("Question/insert") }}">
  {{ csrf_field() }}
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-sm-4">
                <label>Type:</label><span style="color:red">*</span>
                <select onchange="getCat(this)" class="form-control" name="type" required="">
                  <option disabled="" selected="">Select Type</option>
                  <option value="0">Founder</option>
                  <option value="1">Investor</option>
                </select>
              </div>
              <div class="col-sm-4">
                <label>Question Desc:</label><span style="color:red">*</span>
                <input type="text" name="question_desc" class="form-control" placeholder="Question Desc" required="">
              </div>
              <div class="col-sm-4">
                <label>Question Type:</label><span style="color:red">*</span>
                <select class="form-control" name="q_type" required="">
                  <option disabled="" selected="">Select Question Type</option>
                  <option value="Text">Text</option>
                  <option value="text_area">Text Area</option>
                  <option value="number">Phone Number</option>
                  <option value="int">Integer</option>
                  <option value="email">Email</option>
                  <option value="dropdown">Dropdown</option>
                  <option value="checkbox">Checkbox</option>
                  <option value="radio">Radio</option>
                </select>
              </div>
              <div class="col-sm-4  mt-3">
                <label>Service Sector:</label><span style="color:red">*</span>
                <select class="form-control" name="ss" required="">
                  <option disabled="" selected="">Select Service Sector</option>
                  @foreach( $service_sector as $key => $ss )
                    <option value="{{ $ss->id }}">{{ $ss->ss_title }}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-sm-4 mt-3">
                <label>Category:</label><span style="color:red">*</span>
                <select class="form-control" name="_category" id="_category" required="">
                  <option disabled="" selected="">Select Category</option>
                </select>
              </div>
              <div class="col-sm-4 mt-3">
                <div class="custom-control custom-switch mt-5">
                    <input onchange="multiInput(this)" type="checkbox" name="multi_input" class="custom-control-input" id="switch1">
                    <label class="custom-control-label" for="switch1">Multi Inputs</label>
                </div>
              </div>
            </div>
            <div id="multi_input_option">
            <h5 class="mt-4">Multi Options:</h5>
              <div class="row row_0 pb-3">
                <div class="col-sm-3 p-0 pl-3">
                  <input type="text" name="question_opt[]" class="form-control" placeholder="Option">
                </div>
                <div class="col-sm-1 p-0 pl-2">
                  <button type="button" onclick="_append()" class="btn btn-sm btn-dark" style="padding:9px;"><i class="fa fa-plus"></i></button>
                  <button type="button" onclick="_destroy(0)" class="_destroy_btn btn btn-sm btn-dark" style="padding:9px;"><i class="fa fa-minus"></i></button>
                </div>
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
   $('#multi_input_option').hide();
   function getCat(e) {
    $('#_category').html('<option disabled="" selected="">Select Category</option>');
    $.ajax({
      url: '{{ url("Question/get-cat") }}/'+$(e).val(),
      type: 'get',
      dataType: 'json',

    })
    .done(function(resp) {
      var option='';
      $(resp).each(function(i, val) {
          option+='<option value="'+val.id+'">'+val.category+'</option>';
      });
        $('#_category').html(option);
    })
    .fail(function() {
      console.log("error");
    })
    
   }
   var appended_key=1;
   var appended_count=1;
   function _append() {
    
     var opt_row='<div class="row row_'+appended_key+' pb-3"><div class="col-sm-3 p-0 pl-3"> <input type="text" name="question_opt[]" class="form-control" placeholder="Option"></div><div class="col-sm-1 p-0 pl-2"> <button type="button" onclick="_append()" class="btn btn-sm btn-dark" style="padding:9px;"><i class="fa fa-plus"></i></button> <button onclick="_destroy('+appended_key+')" type="button" class="_destroy_btn btn btn-sm btn-dark" style="padding:9px;"><i class="fa fa-minus"></i></button></div></div>';

     $('#multi_input_option').append(opt_row);
     appended_key++;
     appended_count++;

     if( appended_count==1 ){
       $('._destroy_btn').hide();
     }else{
       $('._destroy_btn').show();
     }
   }
   if( appended_count==1 ){
     $('._destroy_btn').hide();
   }else{
     $('._destroy_btn').show();
   }
   function _destroy(key) {
    
      if( appended_count > 1 ){
        $('.row_'+key).remove();
        appended_count--;
      }
      if( appended_count==1 ){
        $('._destroy_btn').hide();
      }else{
        $('._destroy_btn').show();
      }
   }
   function multiInput(e) {
     if ($(e).is(':checked')) {
      $('#multi_input_option').show();  
     }else{
      $('#multi_input_option').hide();
     }
   }
 </script>
@endsection