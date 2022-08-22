<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from codervent.com/dashtreme/demo/dashtreme-light/authentication-signin.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 23 Nov 2019 04:25:26 GMT -->
<head>
  <meta charset="utf-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
  <meta name="description" content=""/>
  <meta name="author" content=""/>
  <title>Login Page</title>
  <!--favicon-->
  <link rel="icon" href="{{asset('theme/assets/images/favicon.ico')}}" type="image/x-icon">
  <!-- Bootstrap core CSS-->
  <link href="{{asset('theme/assets/css/bootstrap.min.css')}}" rel="stylesheet"/>
  <!-- animate CSS-->
  <link href="{{asset('theme/assets/css/animate.css')}}" rel="stylesheet" type="text/css"/>
  <!-- Icons CSS-->
  <link href="{{asset('theme/assets/css/icons.css')}}" rel="stylesheet" type="text/css"/>
  <!-- Custom Style-->
  <link href="{{asset('theme/assets/css/app-style.css')}}" rel="stylesheet"/>
  
</head>

<body>

<!-- start loader -->
   <div id="pageloader-overlay" class="visible incoming"><div class="loader-wrapper-outer"><div class="loader-wrapper-inner" ><div class="loader"></div></div></div></div>
   <!-- end loader -->

<!-- Start wrapper-->
 <div id="wrapper">

 <div class="loader-wrapper"><div class="lds-ring"><div></div><div></div><div></div><div></div></div></div>
 @if ($errors->any())
     @foreach ($errors->all() as $error)
     <div class="alert alert-danger alert-dismissible" role="alert" style="">
			<button type="button" class="close" data-dismiss="alert">×</button>
			<div class="alert-icon">
			 <i class="fa fa-times"></i>
			</div>
			<div class="alert-message">
			  <span><strong>Alert!</strong>{{$error}}</span>
			</div>
		  </div>     @endforeach
 @endif   
 <div class="card card-authentication1 mx-auto my-5">
		<div class="card-body">
		 <div class="card-content p-2">
		 	<div class="text-center">
		 		<img src="{{asset('theme/assets/images/logo-icon.png')}}" alt="logo icon">
		 	</div>
		  <div class="card-title text-uppercase text-center py-3">Sign In</div>
          <form method="POST" action="{{ route('login') }}">
                        @csrf			  <div class="form-group">
			  <label for="exampleInputUsername" class="sr-only">Username</label>
			   <div class="position-relative has-icon-right">
				  <input type="text" id="exampleInputUsername"  name="email" value="{{ old('email') }}" required autocomplete="email" class="form-control input-shadow" placeholder="Enter Username">
				  <div class="form-control-position">
					  <i class="icon-user"></i>
				  </div>
			   </div>
			  </div>
			  <div class="form-group">
			  <label for="exampleInputPassword" class="sr-only">Password</label>
			   <div class="position-relative has-icon-right">
				  <input type="password" id="exampleInputPassword" class="form-control input-shadow" name="password" required autocomplete="current-password" placeholder="Enter Password">
				  <div class="form-control-position">
					  <i class="icon-lock"></i>
				  </div>
			   </div>
			  </div>
			<div class="form-row">
			 <div class="form-group col-6">
			   <div class="icheck-material-primary">
                <input type="checkbox" id="user-checkbox "name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}/>
                <label for="user-checkbox">Remember me</label>
			  </div>
			 </div>
			 <div class="form-group col-6 text-right">
			  <a href="{{ route('password.request') }}">Reset Password</a>
			 </div>
			</div>
			 <button type="submit" class="btn btn-primary btn-block">Sign In</button>
			  
			 
			 
			 </form>
		   </div>
		  </div>
		  <div class="card-footer text-center py-3">
		  </div>
	     </div>
    
     <!--Start Back To Top Button-->
    <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
    <!--End Back To Top Button-->
	
	<!--start color switcher-->
   
  <!--end color cwitcher-->
	
	</div><!--wrapper-->
	
  <!-- Bootstrap core JavaScript-->
  <script src="{{asset('theme/assets/js/jquery.min.js')}}"></script>
  <script src="{{asset('theme/assets/js/popper.min.js')}}"></script>
  <script src="{{asset('theme/assets/js/bootstrap.min.js')}}"></script>
	
  <!-- sidebar-menu js -->
  <script src="{{asset('theme/assets/js/sidebar-menu.js')}}"></script>
  
  <!-- Custom scripts -->
  <script src="{{asset('theme/assets/js/app-script.js')}}"></script>
  
</body>

<!-- Mirrored from codervent.com/dashtreme/demo/dashtreme-light/authentication-signin.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 23 Nov 2019 04:25:26 GMT -->
</html>
