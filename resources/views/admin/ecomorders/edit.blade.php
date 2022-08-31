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
 
				    <form  method="POST" action="{{route('shoporders.update',$order->id)}}" enctype="multipart/form-data">  
						@csrf
                        @method('PATCH')


                     <div class="form-group row">
					  <label for="input-25" class="col-sm-2 col-form-label">Choose Buyer</label>
					  <div class="col-sm-10">
                        <select class="form-control" name="buyer_id" required>
							<option>Choose One...</option>
							@foreach($users as $userss)
                            @if($userss->id == $order->buyer_id)
							<option value="{{$userss->id}}" selected>{{$userss->name}}</option>
                            @else
                            <option value="{{$userss->id}}">{{$userss->name}}</option>
                            @endif
							@endforeach
						</select>
					  </div>
                     </div>

                     <div class="form-group row">
					  <label for="input-27" class="col-sm-2 col-form-label">Choose One</label>
					  <div class="col-sm-10">
                        <select name="payment_status" class="form-control">
                            @if($order->payment_status=='Pending')
                            <option value="Pending" selected>Pending</option>
                            @else
                            <option value="Pending">Pending</option>>
                            @endif

                            @if($order->payment_status=='Paid')
                            <option value="Paid" selected>Paid</option>
                            @else
                            <option value="Paid">Paid</option>>
                            @endif

                        </select>
					  </div>
                     </div>

                     <div class="form-group row">
					  <label for="input-27" class="col-sm-2 col-form-label">Choose One</label>
					  <div class="col-sm-10">
                        <select name="delivery_status" class="form-control">

                            @if($order->delivery_status=='In Process')
                            <option value="In Process" selected>In Process</option>
                            @else
                            <option value="In Process">In Process</option>>
                            @endif

                            @if($order->delivery_status=='Delivered')
                            <option value="Delivered" selected>Delivered</option>
                            @else
                            <option value="Delivered">Delivered</option>>
                            @endif

                            @if($order->delivery_status=='Cancelled')
                            <option value="Cancelled" selected>Cancelled</option>
                            @else
                            <option value="Cancelled">Cancelled</option>>
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
@endsection