<!DOCTYPE html>
<html lang="en">
  
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../assets/images/favicon.png" type="image/x-icon">
    <link rel="shortcut icon" href="../assets/images/favicon.png" type="image/x-icon">
    <title>BLIG - Black Lion Investment Group</title>
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Work+Sans:100,200,300,400,500,600,700,800,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Font Awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/icofont.css') }}">
    <!-- Themify icon-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/themify.css') }}">
    <!-- Flag icon-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/flag-icon.css') }}">
    <!-- Feather icon-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/feather-icon.css') }}">
    <!-- Plugins css start-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/chartist.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/prism.css') }}">
    <!-- Plugins css Ends-->
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.css') }}">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
    <link id="color" rel="stylesheet" href="{{ asset('assets/css/light-1.css') }}" media="screen">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/responsive.css') }}">

    <style>
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
        background: url(../public/img/bg.jpg);
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

  </head>
  <body>
    <!-- Loader starts-->
    <div class="loader-wrapper">
      <div class="loader bg-white">
        <div class="whirly-loader"> </div>
      </div>
    </div>
    <!-- Loader ends-->
    <!-- page-wrapper Start-->
    <div class="page-wrapper">
      <div class="auth-bg">
        <div class="authentication-box ">
          <div class="text-center"><img src="{{ asset('img/logo-alt.png') }}" alt="" class="login_logo"></div>
          <div class="card mt-4">
            <div class="card-body">
              <div class="text-center">
                <h4>LOGIN</h4>
                <h6>Enter your Username and Password </h6>
              </div>
              <form class="theme-form" method="POST" action="{{ route('login') }}">
                {{ csrf_field() }}
                <div class="form-group">
                  <label class="col-form-label pt-0">{{ __('E-Mail Address') }}</label>
                  <input class="form-control" name="email" type="text" required="" value="{{ old('email') }}">
                  @error('email')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                </div>
                <div class="form-group">
                  <label class="col-form-label">{{ __('Password') }}</label>
                  <input class="form-control" type="password" name="password" required="">
                </div>
                <div class="checkbox p-0">
                  <input id="checkbox1" type="checkbox" {{ old('remember') ? 'checked' : '' }}>
                  <label for="checkbox1">Remember me</label>
                </div>
                <div class="form-group form-row mt-3 mb-0">
                  <button class="btn btn-dark btn-block" type="submit">Login</button>
                </div>
               
               {{--  <div class="col-12 text-center mt-3 ">
                  <div class="text-left mt-2 m-l-20">Forgot your Password <a class="btn-link text-capitalize" href="reset-password.html">Reset Password</a></div>
                </div> --}}
               {{--  <div class="col-12 text-center mt-3 ">
                  <div class="text-left mt-2 m-l-20">Don't have an Account <a class="btn-link text-capitalize" href="signup-image.html">Sign Up</a></div>
                </div> --}}
                {{-- <div class="login-divider"></div> --}}
               {{--  <div class="social mt-3">
                  <div class="form-group btn-showcase d-flex">
                    <button class="btn social-btn btn-fb d-inline-block"> <i class="fa fa-facebook"></i></button>
                    <button class="btn social-btn btn-twitter d-inline-block"><i class="fa fa-google"></i></button>
                    <button class="btn social-btn btn-google d-inline-block"><i class="fa fa-twitter"></i></button>
                    <button class="btn social-btn btn-github d-inline-block"><i class="fa fa-github"></i></button>
                  </div>
                </div> --}}
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- latest jquery-->
    <script src="{{ asset('assets/js/jquery-3.2.1.min.js') }}"></script>
    <!-- Bootstrap js-->
    <script src="{{ asset('assets/js/bootstrap/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap/bootstrap.js') }}"></script>
    <!-- feather icon js-->
    <script src="{{ asset('assets/js/icons/feather-icon/feather.min.js') }}"></script>
    <script src="{{ asset('assets/js/icons/feather-icon/feather-icon.js') }}"></script>
    <!-- Sidebar jquery-->
    <script src="{{ asset('assets/js/sidebar-menu.js') }}"></script>
    <script src="{{ asset('assets/js/config.js') }}"></script>
    <!-- Plugins JS start-->
    <!-- Plugins JS Ends-->
    <!-- Theme js-->
    <script src="{{ asset('assets/js/script.js') }}"></script>
    <!-- Plugin used-->
  </body>

<!-- Mirrored from admin.pixelstrap.com/endless/ltr/login-image.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 30 Apr 2020 10:51:02 GMT -->
</html>