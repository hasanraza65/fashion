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
				    <form  method="POST" action="{{route('fabric.store')}}" enctype="multipart/form-data">  
						@csrf
					 <div class="form-group row">
					  <label for="input-21" class="col-sm-2 col-form-label">Fabric Name</label>
					  <div class="col-sm-10">
                        <input type="text" class="form-control" id="input-21" placeholder="Enter Fabric Name" name="name" value="" required autocomplete="name" autofocus>
                  
					  </div>
                    </div>
                    
                    <div class="form-group row">
					  <label for="input-21" class="col-sm-2 col-form-label">Fabric Description</label>
					  <div class="col-sm-10">
                        <input type="text" class="form-control" id="input-21" placeholder="Enter Fabric Description" name="description" value="" required autocomplete="name" autofocus>
                  
					  </div>
                    </div>
                    
                    <div class="form-group row">
					  <label for="input-21" class="col-sm-2 col-form-label">Fabric Price</label>
					  <div class="col-sm-10">
                        <input type="text" class="form-control" id="input-21" placeholder="Enter Fabric Price" name="price" value="" required autocomplete="name" autofocus>
                  
					  </div>
					</div>

					<div class="form-group row">
       <label class="col-sm-2 col-form-label" >   Select Icon Image</label>
       <div class=col-sm-10">
        <input type="file" name="image" / required>
        
       </div>
      </div>
      </div>
					  
					
					 
					
					 <div class="form-group row">
					  <label class="col-sm-2 col-form-label"></label>
					  <div class="col-sm-10">
						<button type="submit" class="btn btn-primary px-5"><i class="icon-lock"></i> Create</button>
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