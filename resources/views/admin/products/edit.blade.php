@extends('layouts.admin')

@section('content')

<script>
$(document).ready(function(){
  $("#addRow").click(function(){
    var newrow = `<tr>
						<td><input placeholder="Size Name i.e. Small" type="text" class="form-control" name="size_name[]"></td>
						<td><input placeholder="Quantity" type="number" class="form-control" name="quantity[]"></td>
						<td><button type="button" id="deleteRow" class="btn btn-danger">Remove</button></td>
					</tr>`;

		//$('#sizes_table').prepend(newrow);

		$('#sizes_table tr:last').after(newrow);
  });
});
</script>

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
 
				    <form  method="POST" action="{{route('products.update',$product->id)}}" enctype="multipart/form-data">  
						@csrf
                        @method('PATCH')
					 <div class="form-group row">
					  <label for="input-21" class="col-sm-2 col-form-label">Product Name</label>
					  <div class="col-sm-10">
                        <input value="{{$product->name}}" type="text" class="form-control" id="input-21" placeholder="Enter Product Name" name="name" value="" required autocomplete="name" autofocus>
					  </div>
                     </div>

                     <div class="form-group row">
					  <label for="input-22" class="col-sm-2 col-form-label">Product Image</label>
					  <div class="col-sm-10">
                        <input type="file"  id="input-22" name="image" value=""><br>
                        @if(isset($product->image))
                        <img src="{{$product->image}}" width="80">
                        @endif
                        <input type="hidden" value="{{$product->image}}" name="oldimgs">
					  </div>
                     </div>

                     <!--- gallery imgs ---> 

                     <div class="form-group row">
					  <label for="input-22" class="col-sm-2 col-form-label">Product Gallery Images</label>
					  <div class="col-sm-10">
                        <input type="file"  id="input-22" name="gallery_images[]" value="" multiple>
					  </div>
                     </div>

                     <div class="p-4 row">
                        @foreach($product->galleryImages as $galleryimgs)
                        
                        <div class="col-md-3" id="gal_img{{$galleryimgs->id}}">
                        <input type="hidden" name="old_gal_imgs[]" value="{{$galleryimgs->image}}">
                        <img src="/{{$galleryimgs->image}}" class="m-2" alt="Gallery Image" width="120" height="100">
                        <button onclick="removeGalImg({{$galleryimgs->id}})" type="button" class="btn btn-danger btn-sm mr-4">X</button>
                        </div>

                        @endforeach
                    </div>

                     <!--- gallery imgs --->

                     <div class="form-group row">
					  <label for="input-23" class="col-sm-2 col-form-label">Short Description</label>
					  <div class="col-sm-10">
                        <textarea rows="5" class="form-control" name="sort_description" placeholder="Enter Short Description">{{$product->sort_description}}</textarea>
					  </div>
                     </div>

                     <div class="form-group row">
					  <label for="input-24" class="col-sm-2 col-form-label">Long Description</label>
					  <div class="col-sm-10">
                        <textarea rows="10" class="form-control" name="description" placeholder="Enter Long Description">{{$product->description}}</textarea>
					  </div>
                     </div>

                     <div class="form-group row">
					  <label for="input-25" class="col-sm-2 col-form-label">Choose Category</label>
					  <div class="col-sm-10">
                        <select class="form-control" name="p_category" required>
							<option>Choose One...</option>
							@foreach($categories as $categoriess)
                            @if($categoriess->id == $product->category_id)
							<option value="{{$categoriess->id}}" selected>{{$categoriess->name}}</option>
                            @else
                            <option value="{{$categoriess->id}}">{{$categoriess->name}}</option>
                            @endif
							@endforeach
						</select>
					  </div>
                     </div>
                    
                     <!--- product sizes --> 
                     <div class="card p-4">
						<h5>Product Sizes</h5>
						<table class="table" id="sizes_table">
							<tr>
								<th>Size</th>
								<th>Quantity</th>
								<th>Remove</th>
							</tr>
                            @foreach($product->sizes as $product_sizes)
							<tr>
								<td><input value="{{$product_sizes->size_name}}" placeholder="Size Name i.e. Small" type="text" class="form-control" name="size_name[]"></td>
								<td><input value="{{$product_sizes->size_qty}}" placeholder="Quantity" type="number" class="form-control" name="quantity[]"></td>
								<td><button type="button" id="deleteRow" class="btn btn-danger">Remove</button></td>
							</tr>
                            @endforeach
						</table>
						<td><button type="button" id="addRow" class="btn btn-primary">Add</button></td>
					 </div>
                     <!--- ending product sizes --> 

                     <div class="form-group row">
					  <label for="input-25" class="col-sm-2 col-form-label">Product Quantities</label>
					  <div class="col-sm-10">
                        <input min="0" value="{{$product->p_qty}}" type="number" class="form-control" id="input-25" placeholder="Enter Product QTY" name="p_qty" value="" required autocomplete="p_qty" autofocus>
					  </div>
                     </div>

                     <div class="form-group row">
					  <label for="input-26" class="col-sm-2 col-form-label">Product Price (Per Quantity)</label>
					  <div class="col-sm-10">
                        <input min="0" value="{{$product->p_price}}" type="number" class="form-control" id="input-26" placeholder="Enter Product Per QTY Price" name="p_price" value="" required autocomplete="p_qty" autofocus>
					  </div>
                     </div>

                     <div class="form-group row">
					  <label for="input-27" class="col-sm-2 col-form-label">Choose One</label>
					  <div class="col-sm-10">
                        <select name="is_active" class="form-control">
                            @if($product->is_active==1)
                            <option value="1" selected>Active</option>
                            <option value="0">Inactive</option>
                            @else
                            <option value="1">Active</option>
                            <option value="0" selected>Inactive</option>
                            @endif
                        </select>
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

<script>
    function removeGalImg(id){

        $('#gal_img'+id).remove();

    }
</script>

<script>

$("#sizes_table").on("click", "#deleteRow", function() {
   $(this).closest("tr").remove();
});

</script>

@endsection