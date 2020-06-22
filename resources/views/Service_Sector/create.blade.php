@extends('layout.layout')
@section('title')
Create Service Sector
@endsection
@section('css')
 
@endsection
@section('content')
<form method="post" action="{{ url("service-sector/insert") }}" enctype="multipart/form-data">
  {{ csrf_field() }}
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-body">
              <div class="form-row">
                <div class="col-md-4 mb-3">
                  <label for="validationDefault01">Service Sector name</label>
                  <input class="form-control" id="validationDefault01" name="ss_image" type="text" placeholder="First name" required="">
                </div>
                
                <div class="custom-file col-md-4 col-12  mb-4" style="margin-top: 29px">
                <input class="custom-file-input " id="validatedCustomFile" type="file" name="file">
                <label class="custom-file-label" for="validatedCustomFile">Upload Image...</label>
                <div class="invalid-feedback">Example invalid custom file feedback</div>
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
 
@endsection