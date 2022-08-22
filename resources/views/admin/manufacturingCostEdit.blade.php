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
				   <div class="card-title">{{$title}}</div>
				   <hr>
				    <form  method="POST" action="{{route('manufacturing_cost.update',$manufacturing_cost->id)}}" enctype="multipart/form-data">  
                        @csrf
                        @method('PUT')
					 <div class="form-group row">
					  <label for="input-21" class="col-sm-2 col-form-label">Style No</label>
					  <div class="col-sm-10">
                        <input type="number" class="form-control" id="input-21" placeholder="Enter Style Number" name="style_no" value="{{$manufacturing_cost->style_no}}" required autocomplete="name" autofocus>
                  
					  </div>
                    </div>

                    <div class="form-group row">
					  <label for="input-21" class="col-sm-2 col-form-label">Style Name</label>
					  <div class="col-sm-10">
                        <input type="text" class="form-control" id="input-21" placeholder="Enter Style Name" name="style_name" value="{{$manufacturing_cost->style_name}}" required autocomplete="name" autofocus>
                  
					  </div>
                    </div>
                    
                  
                    
                    <div class="form-group row">
					  <label for="input-21" class="col-sm-2 col-form-label">MAnufacturing Cost</label>
					  <div class="col-sm-10">
                        <input type="number" class="form-control" id="input-21" placeholder="Enter Manufacturing Cost " name="manufacturing_cost" value="{{$manufacturing_cost->manufacturing_cost}}" required autocomplete="name" autofocus>
                  
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