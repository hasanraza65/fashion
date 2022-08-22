@extends('layouts.admin')

@section('content')

    <div class="container-fluid">
        <!-- Breadcrumb-->
        <div class="row pt-2 pb-2">
            <div class="col-sm-12">
                <h4 class="page-title">{{$title}}</h4>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{$title}}</li>
                </ol>
            </div>
        </div>
        <!-- End Breadcrumb-->
        <div class="row">
        <div class="col-lg-12">
			   
			   <div class="card">
			     <div class="card-body">
				   <div class="card-title">Admin Registration</div>
				   <hr>
				    <form  method="POST" action="{{ route('admin.store') }}">  
                        @csrf
					 <div class="form-group row">
					  <label for="input-21" class="col-sm-2 col-form-label">Name</label>
					  <div class="col-sm-10">
                        <input type="text" class="form-control" id="input-21" placeholder="Enter Your Name" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                        @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
					  </div>
					</div>
					<div class="form-group row">
					  <label for="input-22" class="col-sm-2 col-form-label">Email</label>
					  <div class="col-sm-10">
                        <input type="email" class="form-control" id="input-22" placeholder="Enter Your Email Address" name="email" value="{{ old('email') }}" required autocomplete="email">
                        @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
					  </div>
					</div>
					  <div class="form-group row">
						<label for="input-23" class="col-sm-2 col-form-label">Mobile</label>
						<div class="col-sm-10">
						<input type="phone" class="form-control" id="input-23" placeholder="Enter Your Mobile Number" name="phone" value="{{ old('phone') }}" required autocomplete="phone">
                        @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror    
                    </div>
					  </div>
					<div class="form-group row">
					  <label for="input-24" class="col-sm-2 col-form-label">Password</label>
					  <div class="col-sm-10">
						<input type="password" class="form-control" id="input-24" placeholder="Enter Password" name="password" required autocomplete="new-password">
                        @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror  
                    </div>
					</div>
					  <div class="form-group row">
						<label for="input-25" class="col-sm-2 col-form-label">Confirm Password</label>
						<div class="col-sm-10">
						<input type="password" class="form-control" id="input-25" placeholder="Confirm Password" name="password_confirmation" required autocomplete="new-password">
						</div>
					  </div>
					<div class="form-group row">
					  <label class="col-sm-2 col-form-label"></label>
					  <div class="col-sm-10">
						<div class="icheck-material-primary">
						
					  </div>
					  </div>
					</div>
					 <div class="form-group row">
					  <label class="col-sm-2 col-form-label"></label>
					  <div class="col-sm-10">
						<button type="submit" class="btn btn-primary px-5"><i class="icon-lock"></i> Register</button>
					  </div>
					</div>
					</form>
				 </div>
			 </div>


       
    </div>
    <!-- End container-fluid-->
</div>
<!--End content-wrapper-->
<!--Start Back To Top Button-->
<a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
<!--End Back To Top Button-->
<!--Start footer-->
@endsection