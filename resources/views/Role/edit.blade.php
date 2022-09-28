@extends('layout.layout')
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
  .row div{
    white-space: nowrap;
  }
</style>
@endsection
@section('content')
<form method="post" action="{{ url("role/edit") }}/{{ $role_id }}">
  {{ csrf_field() }}
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
        
          <div class="card-body">
            <div class="row">
              <div class="col-4">
                <label>Role Name:</label>
                <input type="text" value="{{ $role->name }}" class="form-control" name="role_name" placeholder="Role Name">
              </div>
              <div class="col-4">
                <label>Score:</label>
                <div class="range-slider">
                  <input class="range-slider__range" name="score" type="range" value="{{ $role->score_weight }}" min="0" max="100">
                  <span class="range-slider__value">0</span> 
                </div>
              </div>
            </div>
            <div class="row">
              
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          
          <div class="card-body">
              <fieldset>

              <!-- User -->
              <div class="form-group row mb-5">
                <h5 class="col-sm-12 control-label text-lg-left mb-4" for="user">User</h5>
                <div class="col-sm-12"><div class="m-checkbox-inline">
               
                <div class="row">
                  
                <div class="col-12 col-md-6 col-lg-3">

                   <input type="checkbox" name="" id="check-allUser" value="1">
                  <label class="checkbox-inline mb-0" for="checkboxes-0">
                         Check All
                  </label> 
                </div>

                <div class="col-12 col-md-6 col-lg-3">
                   <input 
                   @foreach($role->_permission as $key => $p) 
                         {{ $p->permission_id==1 ? 'checked' : '' }} 
                   @endforeach
                   type="checkbox" name="permission[]" class="checkUser" id="Add-User" value="1">
               <label class="checkbox-inline mb-0" for="checkboxes-1">
                         Add New User
                  </label> 

                </div>
                

                <div class="col-12 col-md-6 col-lg-3">
                   <input 
                   @foreach($role->_permission as $key => $p) 
                         {{ $p->permission_id==2 ? 'checked' : '' }} 
                   @endforeach
                   type="checkbox" name="permission[]" class="checkUser" id="All-User" value="2">
               <label class="checkbox-inline mb-0" for="All-User">
                         All Users
                  </label>
                </div> 
                

                <div class="col-12 col-md-6 col-lg-6">
                   <input 
                    @foreach($role->_permission as $key => $p) 
                          {{ $p->permission_id==3 ? 'checked' : '' }} 
                    @endforeach
                   type="checkbox" name="permission[]" class="checkUser" id="ViewSingle-User" value="3">
                  <label class="checkbox-inline mb-0" for="ViewSingle-User">
                         View Single User
                  </label> 
                </div>

                <div class="col-12 col-md-6 col-lg-6 mt-2">
                   <input 
                   @foreach($role->_permission as $key => $p) 
                         {{ $p->permission_id==4 ? 'checked' : '' }} 
                   @endforeach
                   type="checkbox" name="permission[]" class="checkUser" id="DeleteSingle-User" value="4">
                  <label class="checkbox-inline mb-0" for="DeleteSingle-User">
                         Delete User
                  </label> 
                </div>
                </div>
              </div>
              </div>

              </div>

              <!-- Multiple Checkboxes (inline) -->
              <div class="form-group row mb-5">
                <h5 class="col-sm-12 mb-2 control-label text-lg-left mb-4" for="user">Role</h5>
                <div class="col-sm-12"><div class="m-checkbox-inline">
               
               <div class="row">
                
                <div class="col-12 col-md-6 col-lg-3">
                   <input type="checkbox" id="check-allRole" value="1">
               <label class="checkbox-inline mb-0" for="checkboxes-0">
                         Check All
                  </label> 
                </div>
                

                <div class="col-12 col-md-6 col-lg-3">
                  <input 
                  @foreach($role->_permission as $key => $p) 
                        {{ $p->permission_id==5 ? 'checked' : '' }} 
                  @endforeach  
                  type="checkbox" name="permission[]" class="checkRole" id="Add-Role" value="5">
               <label class="checkbox-inline mb-0" for="Add-Role">
                         Add New Role
                  </label> 
                </div>


                <div class="col-12 col-md-6 col-lg-3">
                   <input 
                   @foreach($role->_permission as $key => $p) 
                         {{ $p->permission_id==6 ? 'checked' : '' }} 
                   @endforeach
                   type="checkbox" name="permission[]" class="checkRole" id="All-Role" value="6">
               <label class="checkbox-inline mb-0" for="All-Role">
                         All Role
                  </label> 
                </div>


                <div class="col-12 col-md-6 col-lg-3">
                  <input 
                  @foreach($role->_permission as $key => $p) 
                        {{ $p->permission_id==9 ? 'checked' : '' }} 
                  @endforeach
                  type="checkbox" name="permission[]" class="checkRole" id="Edit-Role" value="9">
               <label class="checkbox-inline mb-0" for="Edit-Role">
                         Edit Role
                  </label> 
                </div>


                <div class="col-12 col-md-4 col-lg-4">                        
                   <input 
                   @foreach($role->_permission as $key => $p) 
                         {{ $p->permission_id==7 ? 'checked' : '' }} 
                   @endforeach
                   type="checkbox" name="permission[]" class="checkRole" id="ViewSingle-Role" value="7">
               <label class="checkbox-inline mb-0" for="ViewSingle-Role">
                         View Single Role
                  </label> 
                </div>

                 <div class="col-12 col-md-6 col-lg-3">
                   <input 
                   @foreach($role->_permission as $key => $p) 
                         {{ $p->permission_id==8 ? 'checked' : '' }} 
                   @endforeach
                   type="checkbox" name="permission[]" class="checkRole" id="Delete-Role" value="8">
                <label class="checkbox-inline mb-0" for="Delete-Role">
                          Delete Role
                   </label> 
                 </div>
                </div>
              </div>
              </div>
              </div>

              <!-- Multiple Checkboxes (inline) -->
              <div class="form-group row mb-5">
                <h5 class="col-sm-12 mb-2 control-label text-lg-left mb-4" for="user">Question-Categories</h5>
                <div class="col-sm-12"><div class="m-checkbox-inline">
               
                
                <div class="row">


                <div class="col-12 col-md-6 col-lg-3">
                   <input type="checkbox" id="check-allCategory" value="1">
               <label class="checkbox-inline mb-0" for="checkboxes-0">
                         Check All
                  </label> 
                </div>


                <div class="col-12 col-md-6 col-lg-3">
                   <input 
                   @foreach($role->_permission as $key => $p) 
                         {{ $p->permission_id==10 ? 'checked' : '' }} 
                   @endforeach
                   type="checkbox" name="permission[]" class="checkCategory" id="Add-Question" value="10">
               <label class="checkbox-inline mb-0" for="Add-Question">
                         Add Categories
                  </label> 
                </div>
                
                <div class="col-12 col-md-6 col-lg-3">
                   <input 
                   @foreach($role->_permission as $key => $p) 
                         {{ $p->permission_id==11 ? 'checked' : '' }} 
                   @endforeach
                   type="checkbox" name="permission[]" class="checkCategory" id="All-Question" value="11">
               <label class="checkbox-inline mb-0" for="All-Question">
                         All Categories
                  </label> 
                </div>

                <div class="col-12 col-md-6 col-lg-3">
                  <input 
                  @foreach($role->_permission as $key => $p) 
                        {{ $p->permission_id==14 ? 'checked' : '' }} 
                  @endforeach
                  type="checkbox" name="permission[]" class="checkCategory" id="Edit-Question" value="14">
               <label class="checkbox-inline mb-0" for="Edit-Question">
                         Edit Categories
                  </label> 
                </div>
                

                <div class="col-12 col-md-4 col-lg-4">
                   <input 
                   @foreach($role->_permission as $key => $p) 
                         {{ $p->permission_id==12 ? 'checked' : '' }} 
                   @endforeach
                   type="checkbox" name="permission[]" class="checkCategory" id="ViewSingle-Question" value="12">
               <label class="checkbox-inline mb-0" for="ViewSingle-Question">
                         View Single Categories
                  </label> 
                </div>
                 <div class="col-12 col-md-6 col-lg-3">
                   <input 
                   @foreach($role->_permission as $key => $p) 
                         {{ $p->permission_id==13 ? 'checked' : '' }} 
                   @endforeach
                   type="checkbox" name="permission[]" class="checkCategory" id="Delete-Question" value="13">
                <label class="checkbox-inline mb-0" for="Delete-Question">
                          Delete Categories
                   </label> 
                 </div>
                </div>
                </div>
              </div>
              </div>

              <!-- QUESTIONS -->
              <div class="form-group row mb-5">
                <h5 class="col-sm-12 mb-2 control-label text-lg-left mb-4" for="user">Question</h5>
                <div class="col-sm-12"><div class="m-checkbox-inline">
               
                
                <div class="row">


                <div class="col-12 col-md-6 col-lg-3">
                   <input type="checkbox" id="check-allQuestions" value="1">
               <label class="checkbox-inline mb-0" for="checkboxes-0">
                         Check All
                  </label> 
                </div>


                <div class="col-12 col-md-6 col-lg-3">
                   <input type="checkbox" name="permission[]" class="checkQuestions" id="Add-Question" value="2">
               <label class="checkbox-inline mb-0" for="Add-Question">
                         Add Question
                  </label> 
                </div>
                
                <div class="col-12 col-md-6 col-lg-3">
                   <input type="checkbox" name="permission[]" class="checkQuestions" id="All-Question" value="3">
               <label class="checkbox-inline mb-0" for="All-Question">
                         All Question
                  </label> 
                </div>

                <div class="col-12 col-md-6 col-lg-3">
                  <input type="checkbox" name="permission[]" class="checkQuestions" id="Edit-Question" value="3">
               <label class="checkbox-inline mb-0" for="Edit-Question">
                         Edit Question
                  </label> 
                </div>
                

                <div class="col-12 col-md-4 col-lg-4">
                   <input type="checkbox" name="permission[]" class="checkQuestions" id="ViewSingle-Question" value="4">
               <label class="checkbox-inline mb-0" for="ViewSingle-Question">
                         View Single Question
                  </label> 
                </div>
                </div>
                </div>
              </div>
              </div>

              <!-- Multiple Checkboxes (inline) -->
              <div class="form-group row mb-5">
                <h5 class="col-sm-12 mb-2 control-label text-lg-left mb-4" for="user">Service Sector Type</h5>
                <div class="col-sm-12"><div class="m-checkbox-inline">
               
                <div class="row">
                <div class="col-12 col-md-6 col-lg-3">
                   <input type="checkbox" id="check-allSerSec" value="1">
               <label class="checkbox-inline mb-0" for="checkboxes-0">
                         Check All
                  </label> 
                </div>
                
                <div class="col-12 col-md-3 col-lg-3">
                   <input type="checkbox" name="permission[]" class="checkSerSec" id="Add-ServiceSector" value="15">
               <label class="checkbox-inline mb-0" for="Add-ServiceSector">
                         Add New Service Sector
                  </label> 
                </div>
                
                <div class="col-12 col-md-3 col-lg-3">
                   <input type="checkbox" name="permission[]" class="checkSerSec" id="All-ServiceSector" value="16">
               <label class="checkbox-inline mb-0" for="All-ServiceSector">
                         All Service Sector
                  </label> 
                </div>

                <div class="col-12 col-md-3 col-lg-3">
                  <input type="checkbox" name="permission[]" class="checkSerSec" id="Edit-ServiceSector" value="19">
               <label class="checkbox-inline mb-2" for="Edit-ServiceSector">
                         Edit Service Sector
                  </label> 
                </div>
                

                <div class="col-12 col-md-3 col-lg-3">
                   <input type="checkbox" name="permission[]" class="checkSerSec" id="ViewSingle-ServiceSector" value="17">
               <label class="checkbox-inline mb-0" for="ViewSingle-ServiceSector">
                         View Service Sector
                  </label> 
                </div>

                 <div class="col-12 col-md-3 col-lg-3">
                    <input type="checkbox" name="permission[]" class="checkSerSec" id="Delete-ServiceSector" value="18">
                <label class="checkbox-inline mb-0" for="Delete-ServiceSector">
                          Delete Service Sector
                   </label> 
                 </div>
              </div>
                
                </div>
              </div>
              </div>

              <!-- Multiple Checkboxes (inline) -->
              <div class="form-group row mb-5">
                <h5 class="col-sm-12 mb-2 control-label text-lg-left mb-4" for="user">Entreprenuer Answers</h5>
                <div class="col-sm-12"><div class="m-checkbox-inline">
               
                
                <div class="row">
                <div class="col-12 col-md-6 col-lg-3">
                   <input type="checkbox" id="check-allEntAwn" value="1">
               <label class="checkbox-inline mb-0" for="checkboxes-0">
                         Check All
                  </label> 
                </div>
                
                <div class="col-12 col-md-3 col-lg-3">
                   <input type="checkbox" name="permission[]" class="checkEntAwn" id="Add-Enterpuneer" value="20">
               <label class="checkbox-inline mb-0" for="Add-Enterpuneer">
                         Add New Questions
                  </label> 
                </div>
                
                <div class="col-12 col-md-6 col-lg-3">
                   <input type="checkbox" name="permission[]" class="checkEntAwn" id="All-Enterpuneer" value="21">
               <label class="checkbox-inline mb-0" for="All-Enterpuneer">
                         All Questions
                  </label> 
                </div>
                
                <div class="col-12 col-md-6 col-lg-3">
                  <input type="checkbox" name="permission[]" class="checkEntAwn" id="Edit-Enterpuneer" value="24">
               <label class="checkbox-inline mb-0" for="Edit-Enterpuneer">
                         Edit Questions
                  </label> 
                </div>
                
                <div class="col-12 col-md-3 col-lg-3 mb-2">
                   <input type="checkbox" name="permission[]" class="checkEntAwn" id="ViewSingle-Enterpuneer" value="22">
               <label class="checkbox-inline mb-0" for="ViewSingle-Enterpuneer">
                         View Questions
                  </label> 
                </div>

                 <div class="col-12 col-md-3 col-lg-3 mb-2">
                    <input type="checkbox" name="permission[]" class="checkEntAwn" id="Delete-Enterpuneer" value="23">
                <label class="checkbox-inline mb-0" for="Delete-Enterpuneer">
                          View Questions
                   </label> 
                 </div>
                  
                <div class="col-12 col-md-6 col-lg-3">
                   <input type="checkbox" name="permission[]" class="checkEntAwn" id="AddScore-Enterpuneer" value="4">
               <label class="checkbox-inline mb-0" for="AddScore-Enterpuneer">
                         Add Score
                  </label> 
                </div>
                  
                  <br><br>
                
                <div class="col-12 col-md-3 col-lg-3">
                   <input type="checkbox" name="permission[]" class="checkEntAwn" id="Percentage-Enterpuneer" value="4">
               <label class="checkbox-inline mb-0" for="Percentage-Enterpuneer">
                         Percentage
                  </label> 
                </div>

                <div class="col-12 col-md-6 col-lg-3">
                   <input type="checkbox" name="permission[]" class="checkEntAwn" id="EditScore-Enterpuneer" value="4">
               <label class="checkbox-inline mb-0" for="EditScore-Enterpuneer">
                         Edit Score
                  </label> 
                </div>

                <div class="col-12 col-md-3 col-lg-3">
                   <input type="checkbox" name="permission[]" class="checkEntAwn" id="ChangeStatus-Enterpuneer" value="4">
               <label class="checkbox-inline mb-0" for="ChangeStatus-Enterpuneer">
                         Change Status
                  </label> 
                </div>
              </div>
                
                </div>
              </div>
              </div>

              <!-- Multiple Checkboxes (inline) -->
              <div class="form-group row mb-5">
                <h5 class="col-sm-12 mb-2 control-label text-lg-left mb-4" for="user">Investor Answers</h5>
                <div class="col-sm-12"><div class="m-checkbox-inline">
               
                <div class="row">
                <div class="col-12 col-md-6 col-lg-3">
                   <input type="checkbox" id="check-allInvAwn" value="1">
               <label class="checkbox-inline mb-0" for="checkboxes-0">
                         Check All
                  </label> 
                </div>
                
                <div class="col-12 col-md-3 col-lg-3">
                   <input type="checkbox" name="permission[]" class="checkInvAwn" id="Add-Investor" value="2">
               <label class="checkbox-inline mb-0" for="Add-Investor">
                         Add New Questions
                  </label> 
                </div>
                
                <div class="col-12 col-md-6 col-lg-3">
                   <input type="checkbox" name="permission[]" class="checkInvAwn" id="All-Investor" value="3">
               <label class="checkbox-inline mb-0" for="All-Investor">
                         All Questions
                  </label> 
                </div>
                
                <div class="col-12 col-md-6 col-lg-3">
                  <input type="checkbox" name="permission[]" class="checkInvAwn" id="Edit-Investor" value="3">
               <label class="checkbox-inline mb-0" for="Edit-Investor">
                         Edit Questions
                  </label> 
                </div>
                
                <div class="col-12 col-md-3 col-lg-3 mb-2">
                   <input type="checkbox" name="permission[]" class="checkInvAwn" id="ViewSingle-Investor" value="4">
               <label class="checkbox-inline mb-0" for="ViewSingle-Investor">
                         View Questions
                  </label> 
                </div>

                <div class="col-12 col-md-6 col-lg-3">
                   <input type="checkbox" name="permission[]" class="checkInvAwn" id="AddScore-Investor" value="4">
               <label class="checkbox-inline mb-0" for="AddScore-Investor">
                         Add Score
                  </label> 
                </div>

                <div class="col-12 col-md-3 col-lg-3 ">
                   <input type="checkbox" name="permission[]" class="checkInvAwn" id="Percentage-Investor" value="4">
               <label class="checkbox-inline mb-0" for="Percentage-Investor">
                         Percentage
                  </label> 
                </div>

                  
                <div class="col-12 col-md-6 col-lg-3">
                   <input type="checkbox" name="permission[]" class="checkInvAwn" id="EditScore-Investor" value="4">
               <label class="checkbox-inline mb-0" for="EditScore-Investor">
                         Edit Score
                  </label> 
                </div>


                <div class="col-12 col-md-6 col-lg-3">
                   <input type="checkbox" name="permission[]" class="checkInvAwn" id="ChangeStatus-Investor" value="4">
               <label class="checkbox-inline mb-0" for="ChangeStatus-Investor">
                         Change Status
                  </label> 
                </div>
              </div>
                
                </div>
              </div>
              </div>

              <!-- Multiple Checkboxes (inline) -->
              <div class="form-group row mb-5">
                <h5 class="col-sm-12 mb-2 control-label text-lg-left mb-4" for="user">Email Templates</h5>
                <div class="col-sm-12"><div class="m-checkbox-inline">
               
                
                <div class="row">
                <div class="col-12 col-md-6 col-lg-3">
                   <input type="checkbox" id="check-allEmail" value="1">
               <label class="checkbox-inline mb-0" for="checkboxes-0">
                         Check All
                  </label> 
                </div>
                
                <div class="col-12 col-md-3 col-lg-3">
                   <input type="checkbox" name="permission[]" class="checkEmail" id="Add-EmailTemplate" value="2">
               <label class="checkbox-inline mb-0" for="Add-EmailTemplate">
                         Add Email Templates
                  </label> 
                </div>
                
                <div class="col-12 col-md-3 col-lg-3">
                   <input type="checkbox" name="permission[]" class="checkEmail" id="All-EmailTemplate" value="3">
               <label class="checkbox-inline mb-0" for="All-EmailTemplate">
                         All Email Templates
                  </label> 
                </div>
                
                <div class="col-12 col-md-3 col-lg-3 mb-2">
                  <input type="checkbox" name="permission[]" class="checkEmail" id="Edit-EmailTemplate" value="3">
               <label class="checkbox-inline mb-0" for="Edit-EmailTemplate">
                         Edit Email Templates
                  </label> 
                </div>
                
                <div class="col-12 col-md-3 col-lg-3">
                   <input type="checkbox" name="permission[]" class="checkEmail" id="ViewSingle-EmailTemplate" value="4">
               <label class="checkbox-inline mb-0" for="ViewSingle-EmailTemplate">
                         View Email Templates
                  </label> 
                </div>
                </div>
                </div>
              </div>
              </div>

              <!-- Multiple Checkboxes (inline) -->
              <div class="form-group row mb-5">
                <h5 class="col-sm-12 mb-2 control-label text-lg-left mb-4" for="user">Membership Plans</h5>
                <div class="col-sm-12"><div class="m-checkbox-inline">
               
                
                <div class="row">
                <div class="col-12 col-md-6 col-lg-3">
                   <input type="checkbox" id="check-allMemPlan" value="1">
               <label class="checkbox-inline mb-0" for="checkboxes-0">
                         Check All
                  </label> 
                </div>
                
                <div class="col-12 col-md-3 col-lg-3">
                   <input type="checkbox" name="permission[]" class="checkMemPlan" id="Add-MemberPlan" value="2">
               <label class="checkbox-inline mb-0" for="Add-MemberPlan">
                         Add Membership Plans
                  </label> 
                </div>
                
                <div class="col-12 col-md-3 col-lg-3">
                   <input type="checkbox" name="permission[]" class="checkMemPlan" id="All-MemberPlan" value="3">
               <label class="checkbox-inline mb-0" for="All-MemberPlan">
                         All Membership Plans
                  </label> 
                </div>

                <div class="col-12 col-md-3 col-lg-3 mb-2">
                  <input type="checkbox" name="permission[]" class="checkMemPlan" id="Edit-MemberPlan" value="3">
               <label class="checkbox-inline mb-0" for="Edit-MemberPlan">
                         Edit Membership Plans
                  </label> 
                </div>
                
                <div class="col-12 col-md-3 col-lg-3">
                   <input type="checkbox" name="permission[]" class="checkMemPlan" id="ViewSingle-MemberPlan" value="4">
               <label class="checkbox-inline mb-0" for="ViewSingle-MemberPlan">
                         View Membership Plans
                  </label> 
                </div>
              </div>
                
                </div>
              </div>
              </div>
              </fieldset>

          </div>
          <div>
            <button type="submit" class="btn btn-dark ml-4">Submit</button> 
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