@extends('layouts.manufacturer')

@section('content')
<style>
  .center-modal-x {
    left: 50%;
    transform: translateX(-50%);
  }
</style>

<div class="container-fluid">
  <!-- Breadcrumb-->
  <div class="row pt-2 pb-2">
    <div class="col-sm-12">
      <h4 class="page-title">{{$title}}</h4>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('manufacturer-web.index')}}">Dashboard</a></li>
        
        <li class="breadcrumb-item active" aria-current="page">{{$title}}</li>
      </ol>
    </div>
  </div>
  <!-- End Breadcrumb-->
  <div class="row">
    <div class="col-lg-12">

      <div class="card">
        <div class="card-body position-relative">
          <div class="card-title">{{$title}}</div>
          <div style="position: absolute; right:20px; top:10px;cursor:pointer;" class="btn bg-secondary text-white" data-toggle="modal" data-target="#view-extra">
            View Extra
          </div>
          <hr>
          <form method="POST" action="{{route('order-manufacturer.update',$order->id)}}">
            @csrf
            @method('PATCH')
            @php
            $user_details=\App\User::find($order->user_id);
            $designer_details=\App\User::find($order->designer_id);
            $fabric=\App\Fabric::find($order->fabric_id);
            @endphp
            <div class="form-group row">
              <label for="input-21" class="col-sm-2 col-form-label">Client Name</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" readonly id="input-21" placeholder="Enter Fabric Name" name="" value="{{$user_details->name}}" required autocomplete="name" autofocus>

              </div>
            </div>

            <div class="form-group row">
              <label for="input-21" class="col-sm-2 col-form-label">Designer Name</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="input-21" placeholder="Enter Fabric Description" readonly name="" value="{{$designer_details->name}}" required autocomplete="name" autofocus>

              </div>
            </div>

            <div class="form-group row">
              <label for="input-21" class="col-sm-2 col-form-label">Fabric To Use</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="input-21" readonly placeholder="Enter Fabric Price" name="" value="{{$fabric->name}}" required autocomplete="name" autofocus>

              </div>
            </div>

            <div class="form-group row">
              <label for="input-21" class="col-sm-2 col-form-label">Order Amount</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="input-21" readonly placeholder="Enter Fabric Price" name="" value="{{$order->amount}} INR" required autocomplete="name" autofocus>

              </div>
            </div>

            <div class="form-group row">
              <label for="input-21" class="col-sm-2 col-form-label">Order Quantity</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="input-21" readonly placeholder="Enter Fabric Price" name="" value="{{$order->no_of_peice}}" required autocomplete="name" autofocus>

              </div>
            </div>

            <div class="form-group row">
              <label for="input-21" class="col-sm-2 col-form-label">Order Status</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="input-21" readonly placeholder="Enter Fabric Price" name="" value="{{$order->order_status}}" required autocomplete="name" autofocus>

              </div>
            </div>

            @php
            $style=\App\Manufacturing_cost::find($order_details->manufacturing_cost_id);
            @endphp
            <div class="form-group row">
              <label for="input-21" class="col-sm-2 col-form-label">Style Name</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="input-21" readonly placeholder="Enter Fabric Price" name="" value="{{$style->style_name}}" required autocomplete="name" autofocus>

              </div>
            </div>

            <div class="form-group row">
              <label for="input-21" class="col-sm-2 col-form-label">Style Number</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="input-21" readonly placeholder="Enter Fabric Price" name="" value="{{$style->style_no}}" required autocomplete="name" autofocus>

              </div>
            </div>

            <div class="form-group row">
              <label for="input-21" class="col-sm-2 col-form-label">Manufacturing Cost</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="input-21" readonly placeholder="Enter Fabric Price" name="" value="{{$style->manufacturing_cost}}" required autocomplete="name" autofocus>

              </div>
            </div>
            @php
            if($order_details->design_image1 && $order_details->design_image2)
            {
            @endphp

           

            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Designer Image Front</label>
              <div class=col-sm-10">
                <a href="{{ $order_details->design_image1 }}" data-fancybox>
                  <img src="{{ $order_details->design_image1 }}" class="img-thumbnail" width="200" />
                </a>

              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Designer Image Back</label>
              <div class=col-sm-10">
                <a href="{{ $order_details->design_image2 }}" data-fancybox>
                  <img src="{{ $order_details->design_image2}}" class="img-thumbnail" width="200" />
                </a>

              </div>
            </div>





            @if($order->order_status=='In Manufacturing')
            <div class="form-group row">
              <label class="col-sm-2 col-form-label"></label>
              <div class="col-sm-10">
                <button type="submit" class="btn btn-primary px-5"><i class="icon-lock"></i> Click When Completed</button>
              </div>
            </div>
            @endif
            @php
            }
            @endphp
          </form>
        </div>
      </div>



    </div>
    <!-- End container-fluid-->
  </div>
  <div class="modal fade" id="view-extra">
    <div class="modal-dialog">
      <div class="modal-content border-secondary center-modal-x" style="width:90vw;">
        <div class="modal-header bg-secondary">
          <h5 class="modal-title text-white">View Extra</h5>
          <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="row pt-3 col-12">
              <h5>
                <span class="pl-3"><u>Trims</u></span>:-
              </h5>
            </div>
            <div class="row col-12 pl-4">

              <div class="col-3">
                <h6 class="">Name</h6>
              </div>
              <div class="col-3">
                <h6 class="">Quantity</h6>
              </div>
              <div class="col-3">
                <h6 class="">Total Amount</h6>
              </div>
            </div>
            @php
            $extra_orders=\App\Extra_order::where('order_id',$order->id)->get();
            @endphp
            <!-- FOR EACH START -->
            @foreach($extra_orders as $extra_order)
            <div class="row col-12 pl-4">
              @php
              $extra=\App\Extra::find($extra_order->extra_id);
              @endphp
              <div class="col-3">
                <p>{{$extra->name}}</p>
              </div>
              <div class="col-3">
                <p>{{$extra_order->quantity}}</p>
              </div>
              <div class="col-5">
                <p>{{$extra_order->total_amount}}₹</p>
              </div>
            </div>
            @endforeach
            <!-- FOR EACH END -->
          </div>

          <div class="row">
            <div class="row pt-3 col-12">
              <h5>
                <span class="pl-3"><u>Extra Fabrics</u></span>:-
              </h5>
            </div>

            <div class="row col-12 pl-4">
              <div class="col-3">
                <h6 class="">Fabric Name</h6>
              </div>
              <div class="col-3">
                <h6 class="">Used For</h6>
              </div>

            </div>
            @php
            $fabric_orders=\App\Fabric_order::where('order_id',$order->id)->get();
            @endphp
            <!-- FOR EACH START -->
            @foreach($fabric_orders as $fabric_order)
            <div class="row col-12 pl-4">
              @php
              $single_fabric=\App\Fabric::find($fabric_order->fabric_id);
              @endphp
              <div class="col-3">
                <p>{{$single_fabric->name}}</p>
              </div>
              <div class="col-3">
                <p>{{$fabric_order->used_for}}</p>
              </div>
            </div>
            @endforeach
            <!-- FOR EACH END -->
          </div>

          <!-- User Details -->
          <div class="row">
            <div class="row pt-3 col-12">
              <h5>
                <span class="pl-3"><u>User Details</u></span>:-
              </h5>
            </div>
            <div class="row col-12 pl-4">

              <div class="col-3">
                <h6 class="">User Name</h6>
              </div>
              <div class="col-3">
                <h6 class="">Mobile Number</h6>
              </div>
              <div class="col-3">
                <h6 class="">Email</h6>
              </div>
              <div class="col-3">
                <h6 class="">Address</h6>
              </div>
            </div>
            @php
            $client=\App\User::find($order->id);
            @endphp
            @if(!empty($client))
            <div class="row col-12 pl-4">
              <div class="col-3">
                <p>{{$client->name}}</p>
              </div>
              <div class="col-3">
                <p>{{$client->phone}}</p>
              </div>
              <div class="col-3">
                <p>{{$client->email}}</p>
              </div>
              <div class="col-3">
                <p>{{$client->address}}</p>
              </div>
            </div>
            @endif
          </div>
          <!-- User Details -->

        </div>
      </div>
    </div>
  </div>
  <!--End content-wrapper-->
  <!--Start Back To Top Button-->
  <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
  <!--End Back To Top Button-->
  <!--Start footer-->
  @endsection