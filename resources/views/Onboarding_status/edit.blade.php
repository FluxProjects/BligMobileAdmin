@extends('layout.layout')
@section('title')
Create New Status
@endsection
@section('css')
 
@endsection
@section('content')
<form method="post" action="{{ url("onboarding-status/update") }}/{{$id}}" enctype="multipart/form-data">
  {{ csrf_field() }}
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-body">
              <div class="form-row">
                <div class="col-md-4 mb-3">
                  <label for="validationDefault01">Status name</label>
                  <input class="form-control" id="validationDefault01" name="onboarding_status" type="text" placeholder="Onboarding status" required="" value="{{ $ss->status }}">
                </div>
              </div>
             
              <button class="btn btn-dark" type="submit">Save</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>

@endsection
@section('jquery')
 <script type="text/javascript">
   $('#onboarding_statusTable').DataTable( {
               "processing": true,
               "serverSide": false,
               'datatype' : 'html',
               "ajax": "{{ url('onboarding-status/all') }}",
       } );
 </script>
@endsection