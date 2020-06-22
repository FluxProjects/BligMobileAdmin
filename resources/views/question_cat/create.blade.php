@extends('layout.layout')
@section('title')
Create Question Category
@endsection
@section('css')
 
@endsection
@section('content')
<form method="post" action="{{ url("question-category/insert") }}">
  {{ csrf_field() }}
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-sm-4">
                <label>Type:</label><span style="color:red">*</span>
                <select class="form-control" name="type" required="">
                  <option disabled="" value="" selected="">Select Type</option>
                  <option value="0">Entrepreneur</option>
                  <option value="1">Investor</option>
                </select>
              </div>
              <div class="col-sm-4">
                <label>Category Name:</label><span style="color:red">*</span>
                <input type="text" name="cat_name" class="form-control" placeholder="Name Here" required="">
              </div>
              <div class="col-sm-4">
                <label>Sequence:</label>
                <input type="text" name="sequence" class="form-control" placeholder="sequence">
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
 
@endsection