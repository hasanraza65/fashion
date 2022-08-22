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
				    <form  method="POST" action="{{route('admin.update',$users->id)}}" enctype="multipart/form-data">  
                        @csrf
                        @method('PATCH')
					 <div class="form-group row">
					  <label for="input-21" class="col-sm-2 col-form-label">Name</label>
					  <div class="col-sm-10">
                        <input type="text" class="form-control" id="input-21" placeholder="Enter Your Name" name="name" value="{{ $users->name }}" required autocomplete="name" autofocus>
                        @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
					  </div>
                    </div>
                    <input type="hidden" value="{{$users->id}}" name="id">
					<div class="form-group row">
					  <label for="input-22" class="col-sm-2 col-form-label">Email</label>
					  <div class="col-sm-10">
                        <input type="email" class="form-control" id="input-22" placeholder="Enter Your Email Address" name="email" value="{{$users->email}}" required autocomplete="email">
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
						<input type="phone" class="form-control" id="input-23" placeholder="Enter Your Mobile Number" name="phone" value="{{ $users->phone }}" required autocomplete="phone">
                        @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror    
                    </div>
					  </div>
            <div class="form-group row">
       <label class="col-sm-2 col-form-label" >   Select Avatar Image</label>
       <div class=col-sm-10">
        <input type="file" name="image" />
        <a href="{{$users->avatar}}" data-fancybox>
              <img src="{{$users->avatar}}" class="img-thumbnail" width="100"  />
        </a>

       </div>
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
						<button type="submit" class="btn btn-primary px-5"><i class="icon-lock"></i> Update</button>
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