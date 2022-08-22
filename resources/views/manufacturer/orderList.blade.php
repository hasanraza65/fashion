@extends('layouts.manufacturer')

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
                <div class="card-header">
                </div>
                <div class="card-header"><i class="fa fa-table"></i>{{$title}}</div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table table-bordered">
                            <thead>
                                <tr>
                                <th>User Name</th>
                                    <th>Designer Name</th>
                                    
                                    <th>Amount</th>
                                    <th>Order Status</th>
                                    <th>Action</th>


                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders_list as $list)
                                <tr>

                                    @php
                                    if($ord)
                                    {
                                    $order=\App\Order::where('id',$list->order_id)->where('order_status','In Manufacturing')->get()->first();
                                    }
                                    else
                                    {
                                    $order=\App\Order::where('id',$list->order_id)->where('order_status','!=','In Manufacturing')->get()->first();
                                    }
                                    if($order)
                                    {
                                    $user_details=\App\User::find($order->user_id);
                                    $designer_details=\App\User::find($order->designer_id);
                                    @endphp
                                    <td>{{$user_details->name}}</td>
                                    <td>{{$designer_details->name}}</td>
                                    <td>{{$order->amount}}</td>
                                   
                                    <td>

                                        <span class="badge badge-pill badge-primary shadow-success m-1">{{$order->order_status}}</span>


                                    </td>
                                    <td>

                                        <a href="{{route('manufacturer-view',$order->id)}}"><button type="button" class="btn btn-secondary btn-round waves-effect waves-light m-1">View Details</button></a>
                                       
                                   
                                    </td>
                                    @php
                                }
                                else
                                {
                                    echo "No Data Found";
                                }
                                @endphp
                                </tr>
                               
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                <th>User Name</th>
                                    <th>Designer Name</th>
                                    
                                    <th>Amount</th>
                                    <th>Order Status</th>
                                    <th>Action</th>

                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- End Row-->
</div>


<!-- End container-fluid-->
</div>
<!--End content-wrapper-->
<!--Start Back To Top Button-->
<a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
<!--End Back To Top Button-->
<!--Start footer-->
@endsection