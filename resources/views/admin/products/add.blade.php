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
				    <form  method="POST" action="{{route('products.store')}}" enctype="multipart/form-data">  
						@csrf

					 <div class="form-group row">
					  <label for="input-21" class="col-sm-2 col-form-label">Product Name</label>
					  <div class="col-sm-10">
                        <input type="text" class="form-control" id="input-21" placeholder="Enter Product Name" name="name" value="" required autocomplete="name" autofocus>
					  </div>
                     </div>

                     <div class="form-group row">
					  <label for="input-22" class="col-sm-2 col-form-label">Product Image</label>
					  <div class="col-sm-10">
                        <input type="file"  id="input-22" name="image" value="">
					  </div>
                     </div>
                      
                      <div class="form-group row">
					  <label for="input-22" class="col-sm-2 col-form-label">Product Gallery Images</label>
					  <div class="col-sm-10">
                        <input type="file"  id="input-22" name="gallery_images[]" value="" multiple>
					  </div>
                     </div>

                     <div class="form-group row">
					  <label for="input-23" class="col-sm-2 col-form-label">Short Description</label>
					  <div class="col-sm-10">
                        <textarea rows="5" class="form-control" name="sort_description" placeholder="Enter Short Description"></textarea>
					  </div>
                     </div>

                     <div class="form-group row">
					  <label for="input-24" class="col-sm-2 col-form-label">Long Description</label>
					  <div class="col-sm-10">
                        <textarea rows="10" class="form-control" name="description" placeholder="Enter Long Description"></textarea>
					  </div>
                     </div>

					 <div class="form-group row">
					  <label for="input-25" class="col-sm-2 col-form-label">Choose Category</label>
					  <div class="col-sm-10">
                        <select class="form-control" name="p_category" required>
							<option>Choose One...</option>
							@foreach($categories as $categoriess)
							<option value="{{$categoriess->id}}">{{$categoriess->name}}</option>
							@endforeach
						</select>
					  </div>
                     </div>

                     <div class="form-group row">
					  <label for="input-25" class="col-sm-2 col-form-label">Product Quantities</label>
					  <div class="col-sm-10">
                        <input min="0" type="number" class="form-control" id="input-25" placeholder="Enter Product QTY" name="p_price" value="" required autocomplete="p_qty" autofocus>
					  </div>
                     </div>

                     <div class="form-group row">
					  <label for="input-26" class="col-sm-2 col-form-label">Product Price (Per Quantity)</label>
					  <div class="col-sm-10">
                        <input min="0" type="number" class="form-control" id="input-26" placeholder="Enter Product Per QTY Price" name="p_price" value="" required autocomplete="p_qty" autofocus>
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