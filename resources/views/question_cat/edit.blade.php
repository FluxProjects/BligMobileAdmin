@extends('layout.layout')
@section('css')
 
@endsection
@section('content')
<form method="post" action="{{ url("question-category/edit") }}/{{ $cat_id }}">
  {{ csrf_field() }}
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-sm-4">
                <label>Type:</label>
                <select class="form-control" name="type" readonly>
                  <option disabled="" selected="">Select Type</option>
                  <option  {{ $type==0 ? 'selected' : '' }} value="0">Entrepreneur</option>
                  <option {{ $type==1 ? 'selected' : '' }} value="1">Investor</option>
                </select>
              </div>
              <div class="col-sm-4">
                <label>Category Name:</label>
                <input type="text" value="{{ $cat->category }}" name="cat_name" class="form-control" placeholder="Name Here">
              </div>
              <div class="col-sm-4">
                <label>Sequence:</label>
                <input type="text"  value="{{ $cat->sequence }}" name="sequence" class="form-control" placeholder="sequence">
              </div>
            </div>
            <button type="Submit" class="btn btn-dark mt-3">Update</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>

@endsection
@section('jquery')
 
@endsection