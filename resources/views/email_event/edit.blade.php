@extends('layout.layout')
@section('title')
Create Event
@endsection
@section('css')
 
@endsection
@section('content')
<form method="post" action="{{ url("email-event/update") }}/{{ $id }}">
  {{ csrf_field() }}
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-sm-4">
                <label>Event Name:</label><span style="color:red">*</span>
                <input value="{{ $event->name }}" type="text" name="event_name" class="form-control" placeholder="Name Here" required="">
              </div>
              <div class="col-sm-4">
                <label>Date:</label><span style="color:red">*</span>
                <input value="{{ $event->date }}" type="date" name="date" class="form-control" required="">
              </div>
              <div class="col-sm-4">
                <label>Time:</label><span style="color:red">*</span>
                <input value="{{ $event->time }}" type="time" name="time" class="form-control" required="">
              </div>
              <div class="col-sm-4 mt-3">
                <label>Event Type:</label>
                <select onchange="eventType(this)" class="form-control" id="event_type" name="event_type" required="">
                  <option disabled="" selected="" value="">Select Event Type</option>
                  <option {{ $event->event_type==1 ? 'selected' : '' }} value="1">Online</option>
                  <option {{ $event->event_type==0 ? 'selected' : '' }} value="0">Offline</option>
                </select>
              </div>
              <div class="col-sm-4 mt-3 _offline">
                <label>Mode:</label>
                <select class="form-control" name="mode" required="">
                  <option disabled="" selected="">Select Mode</option>
                  <option {{ $event->mode_name=='Skype' ? 'selected' : '' }}>Skype</option>
                  <option {{ $event->mode_name=='Zoom' ? 'selected' : '' }}>Zoom</option>
                  <option {{ $event->mode_name=='Whatsap' ? 'selected' : '' }}>Whatsap</option>
                  <option {{ $event->mode_name=='Slack' ? 'selected' : '' }}>Slack</option>
                </select>
              </div>
              <div class="col-sm-4 mt-3 _online">
                <label>Venue:</label><span style="color:red">*</span>
                <input value="{{ $event->venue }}" type="text" name="venue" class="form-control">
              </div>
              <div class="col-sm-4 mt-3 _offline">
                <label>Mode Id:</label><span style="color:red">*</span>
                <input value="{{ $event->mode_id }}" type="text" name="mode_id" class="form-control">
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
 <script>
  $('._online').hide();
  $('._offline').hide();
  setTimeout(function() {

    $('#event_type').change();
  },100);
   function eventType(e) {
     if ($(e).val()==0){
        $('._online').show();
        $('._offline').hide();
     }else{
        $('._online').hide();
        $('._offline').show();
     }
   }
 </script>
@endsection