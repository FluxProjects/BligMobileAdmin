@extends('layout.layout')
@section('title')
Create Role
@endsection
@section('css')
<style type="text/css">
  .range-slider { width: 100%; }

  .range-slider__range {
    -webkit-appearance: none;
   width: calc(100% - (73px));
    height: 10px;
    border-radius: 5px;
    background: #d7dcdf;
    outline: none;
    padding: 0;
    margin: 0;
  }
  .range-slider__range::-webkit-slider-thumb {
   -webkit-appearance: none;
   appearance: none;
   width: 20px;
   height: 20px;
   border-radius: 50%;
   background: #2c3e50;
   cursor: pointer;
   -webkit-transition: background .15s ease-in-out;
   transition: background .15s ease-in-out;
  }
  .range-slider__range::-webkit-slider-thumb:hover {
   background: #F59500;
  }
  .range-slider__range:active::-webkit-slider-thumb {
   background: #F59500;
  }
  .range-slider__range::-moz-range-thumb {
   width: 20px;
   height: 20px;
   border: 0;
   border-radius: 50%;
   background: #2c3e50;
   cursor: pointer;
   -webkit-transition: background .15s ease-in-out;
   transition: background .15s ease-in-out;
  }
  .range-slider__range::-moz-range-thumb:hover {
   background: #F59500;
  }
  .range-slider__range:active::-moz-range-thumb {
   background: #F59500;
  }
  .range-slider__range:focus::-webkit-slider-thumb {
   -webkit-box-shadow: 0 0 0 3px #fff, 0 0 0 6px #F59500;
   box-shadow: 0 0 0 3px #fff, 0 0 0 6px #F59500;
  }

  .range-slider__value {
    display: inline-block;
    position: relative; 
    width: 60px;
    color: #fff;
    line-height: 20px;
    text-align: center;
    border-radius: 3px;
    background: #2c3e50;
    padding: 5px 10px;
    margin-left: 8px;
  }

  .range-slider__value:after {
    position: absolute;
    top: 8px;
    left: -7px;
    width: 0;
    height: 0;
    border-top: 7px solid transparent;
    border-right: 7px solid #2c3e50;
    border-bottom: 7px solid transparent;
    content: '';
  }

  ::-moz-range-track {
   background: #d7dcdf;
   border: 0;
  }
   input::-moz-focus-inner, input::-moz-focus-outer {
   border: 0;
  }

  /*==========================*/
    .logo_size{
      width: 70px;
      margin-left: 100%;
    }

    .login_logo{
      width: 70px;
    }

    .bg_gold{
      background-color: #ebbf56;
    }

    .form-horizontal input{
      border: 1px solid green;
    }

    /*login page styele bg image etc*/
    .auth-bg {
      background: url(../assets/images/other-images/bg.jpg);
      display: -webkit-box;
      display: -ms-flexbox;
      display: flex;
      -webkit-box-align: center;
      -ms-flex-align: center;
      align-items: center;
      -webkit-box-pack: center;
      -ms-flex-pack: center;
      justify-content: center;
      min-height: 100vh;
      padding: 50px 100px
  }
  /*sidebar*/
  .page-wrapper .page-body-wrapper .page-sidebar .main-header-left {
      display: -webkit-inline-box;
      display: -ms-inline-flexbox;
      display: inline-flex;
      width: 100%;
      height: 80px;
      padding: 12px;
      -webkit-box-align: center;
      -ms-flex-align: center;
      align-items: center;
      background-color: #00000C;
      z-index: 15;
      -webkit-box-shadow: -3px 1px 3px 1px rgba(68, 102, 242, 0.1);
      box-shadow: -3px 1px 3px 1px rgba(68, 102, 242, 0.1)
  }
  .page-wrapper .page-body-wrapper .sidebar {
      height: calc(100vh - 80px);
      overflow: auto;
      -webkit-box-shadow: 0 0 11px rgba(69, 110, 243, 0.13);
      box-shadow: 0 0 11px rgba(69, 110, 243, 0.13);
      background-color: black;
  }
</style>
@endsection
@section('content')
<form method="post" action="{{ url("role/insert") }}">
  {{ csrf_field() }}
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
        
          <div class="card-body">
            <div class="row">
              <div class="col-4">
                <label>Group Name:</label>
                <input type="text" class="form-control" name="group_name" placeholder="Group Name">
              </div>
                <div class="col-4">
                  <label>Score:</label>
                  <div class="range-slider">
                    <input class="range-slider__range" name="score" type="range" value="50" min="0" max="100">
                    <span class="range-slider__value">0</span> 
                  </div>
                </div>
                {{-- <div class="col-2">
                  <label style="visibility:hidden;">Score:</label>
                  <div class="custom-control custom-checkbox">
                      <input type="checkbox" class="custom-control-input" id="customCheck" name="example1">
                      <label class="custom-control-label" for="customCheck">Create Group</label>
                    </div>
                </div> --}}
            </div>

            <div class="row mt-3">
              

              <div class="col-4">
                <label>Select Roles:</label>
                <select class="form-control" name="group_roles[]" multiple="true" style="height: 90px">
                  @foreach( $role as $key => $r )
                    <option value="{{ $r->id }}">{{ $r->name }}</option>
                  @endforeach
                </select>
              </div>
            </div>

              
            </div>
            <div class="row mt-3">
              
          </div>
          <div>
            <button type="submit" class="btn btn-dark ml-4 mb-3">Submit</button> 
          </div>
        </div>
      </div>
    </div>
  </div>
  
</form>
@endsection
@section('jquery')
<script>
var rangeSlider = function(){
  
  var slider = $('.range-slider'),
      range = $('.range-slider__range'),
      value = $('.range-slider__value');
    
  slider.each(function(){

    value.each(function(){
      var value = $(this).prev().attr('value');
      $(this).html(value);
    });

    range.on('input', function(){
      $(this).next(value).html(this.value);
    });
  });
};

rangeSlider();

// FOR CHECKED ALL
$("#check-allUser").click(function () {
  $(".checkUser").prop('checked', $(this).prop('checked'));
});
// checkAll Role
$("#check-allRole").click(function () {
  $(".checkRole").prop('checked', $(this).prop('checked'));
});
// Question Category
$("#check-allCategory").click(function () {
  $(".checkCategory").prop('checked', $(this).prop('checked'));
});
// Service Sector Type all
$("#check-allSerSec").click(function () {
  $(".checkSerSec").prop('checked', $(this).prop('checked'));
});
// Enter Awn
$("#check-allEntAwn").click(function () {
  $(".checkEntAwn").prop('checked', $(this).prop('checked'));
});
// invest awn
$("#check-allInvAwn").click(function () {
  $(".checkInvAwn").prop('checked', $(this).prop('checked'));
});
// Email template
$("#check-allEmail").click(function () {
  $(".checkEmail").prop('checked', $(this).prop('checked'));
});
// Membership plan
$("#check-allMemPlan").click(function () {
  $(".checkMemPlan").prop('checked', $(this).prop('checked'));
});
// Questions
$("#check-allQuestions").click(function () {
  $(".checkQuestions").prop('checked', $(this).prop('checked'));
});


</script>
@endsection