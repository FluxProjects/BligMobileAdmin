@extends('layout.layout')
@section('title')
Create Question Category
@endsection
@section('css')
 
@endsection
@section('content')
<form method="post" action="{{ url("Question/update") }}/{{ $id }}">
  {{ csrf_field() }}
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-sm-4">
                <label>Type:</label>
                <select onchange="getCat(this)" class="form-control" name="type">
                  <option disabled="" selected="">Select Type</option>
                  <option value="0" {{ $type == 0 ? 'selected' : '' }}>Entrepreneur</option>
                  <option value="1" {{ $type == 1 ? 'selected' : '' }}>Investor</option>
                </select>
              </div>
              <div class="col-sm-4">
                <label>Question Desc:</label>
                <input type="text" name="question_desc" class="form-control" placeholder="Question Desc" value="{{ $data->question_description }}">
              </div>
              <div class="col-sm-4">
                <label>Question Type:</label>
                <select class="form-control" name="q_type">
                  <option disabled="" selected="">Select Question Type</option>
                  <option {{ $data->type == 'Text' ? 'selected' : '' }} value="Text">Text</option>
                  <option {{ $data->type == 'text_area' ? 'selected' : '' }} value="text_area">Text Area</option>
                  <option {{ $data->type == 'number' ? 'selected' : '' }} value="number">Phone Number</option>
                  <option {{ $data->type == 'int' ? 'selected' : '' }} value="int">Integer</option>
                  <option {{ $data->type == 'email' ? 'selected' : '' }} value="email">Email</option>
                  <option {{ $data->type == 'dropdown' ? 'selected' : '' }} value="dropdown">Dropdown</option>
                  <option {{ $data->type == 'checkbox' ? 'selected' : '' }} value="checkbox">Checkbox</option>
                  <option {{ $data->type == 'radio' ? 'selected' : '' }} value="radio">Radio</option>
                </select>
              </div>
              <div class="col-sm-4  mt-3">
                <label>Service Sector:</label><span style="color:red">*</span>
                <select class="form-control" name="ss" required="">
                  <option disabled="" selected="">Select Service Sector</option>
                  @foreach( $service_sector as $key => $ss )
                    <option {{ $data->_serviceSector->id == $ss->id ? 'selected' : '' }} value="{{ $ss->id }}">{{ $ss->ss_title }}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-sm-4 mt-3">
                <label>Category:</label>
                <select class="form-control" name="_category" id="_category">
                  <option disabled="" selected="">Select Category</option>
                  @foreach( $cat as $key => $c )
                    <option {{ $data->category == $c->category ? 'selected' : '' }} value="{{ $c->id }}">{{ $c->category }}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-sm-4 mt-3">
                <div class="custom-control custom-switch mt-5">
                    <input onchange="multiInput(this)" type="checkbox" {{ $data->multiple_inputs == true ? 'checked' : '' }} name="multi_input" class="custom-control-input" id="switch1">
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
  multiInput();
   function getCat(e) {
      $('#_category').html('<option disabled="" selected="">Select Category</option>');
      $.ajax({
        url: '{{ url("question/get-cat") }}/'+$(e).val(),
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
   var appended_count=0;
   function _append(value='') {
    
     var opt_row='<div class="row row_'+appended_key+' pb-3"><div class="col-sm-3 p-0 pl-3"> <input type="text" name="question_opt[]" class="form-control" value="'+value+'" placeholder="Option"></div><div class="col-sm-1 p-0 pl-2"> <button type="button" onclick="_append()" class="btn btn-sm btn-dark" style="padding:9px;"><i class="fa fa-plus"></i></button> <button onclick="_destroy('+appended_key+')" type="button" class="_destroy_btn btn btn-sm btn-dark" style="padding:9px;"><i class="fa fa-minus"></i></button></div></div>';

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

     if ($('#switch1').is(':checked')) {
      $('#multi_input_option').show();  
      $('#multi_input_option').show();
     }else{
      $('#multi_input_option').hide();
     }
   }

   getAppendedData();
   function getAppendedData() {
     
      // $.ajax({
      //   url: '{{ url('Question/getAppendedData') }}/{{$id}}/{{$type}}',
      //   type: 'get',s
      //   dataType: 'json',
      // })
      // .done(function(resp) {
      //   console.log(resp);
      // })
      // .fail(function() {
      //   console.log("error");
      // });

      var appendedData=<?php print_r(json_encode($multiOpt))?>;
      $(appendedData).each(function(i,val) {
          $('.row_0').remove();
          console.log(val.label);
          _append(val.label);
      });
      
   }



 
 </script>
@endsection