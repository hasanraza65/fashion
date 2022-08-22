@extends('layouts.admin')

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
                                    <th>Transaction Id</th>
                                    <th>Name</th>
                                    <th>User Type</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Action</th>


                                </tr>
                            </thead>
                            <tbody>
                                @foreach($member_transactions as $member_transaction)
                                <a href="#">
                                    <tr>

                                        <td>{{$member_transaction->id}}</td>
                                        @php
                                        $user=\App\User::find($member_transaction->user_id);
                                        @endphp
                                        <td>{{$user->name}}</td>
                                        <td>
                                            @if($user->role_id == 2)
                                            <span class="badge badge-pill badge-light shadow-light m-1">Designer</span>
                                            @else
                                            <span class="badge badge-pill badge-dark shadow-light m-1">Manufacturer</span>
                                            @endif
                                        </td>

                                        <td>{{$member_transaction->amount}}</td>

                                        <td>
                                            @if($member_transaction->status == 'Pending')
                                            <span class="badge badge-pill badge-warning shadow-warning m-1">Pending</span>

                                            @else
                                            <span class="badge badge-pill badge-success shadow-success m-1">Paid</span>

                                            @endif

                                        </td>
                                        <td>

                                            <a href="javascript:void(0);" data-toggle="modal" data-target="#view-bank-details-{{$member_transaction->id}}"><button type="button" class="btn btn-secondary btn-round waves-effect waves-light m-1">View Details</button></a>
                                            <!--Bank Details-->
                                            <div class="modal fade" id="view-bank-details-{{$member_transaction->id}}">
                                                <div class="modal-dialog">
                                                    <div class="modal-content border-secondary center-modal-x" style="width:80vw;">
                                                        <div class="modal-header bg-secondary">
                                                            <h5 class="modal-title text-white">Bank Details</h5>
                                                            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                
                                                                <!-- Account Details -->
                                                                <div class="row col-12">

                                                                    <h5>
                                                                        <span class="pl-3"><u>Account Info</u></span>:-
                                                                    </h5>
                                                                </div>
                                                                <div class="row col-12">

                                                                    <div class="col-3">
                                                                        <h6 class="">Account No</h6>
                                                                    </div>
                                                                    <div class="col-3">
                                                                        <h6 class="">Bank Name</h6>
                                                                    </div>
                                                                    <div class="col-3">
                                                                        <h6 class="">Branch Name</h6>
                                                                    </div>
                                                                    <div class="col-3">
                                                                        <h6 class="">IFSC Code</h6>
                                                                    </div>
                                                                </div>
                                                                @php
                                                                $bank=\App\Bank_detail::where('user_id',$member_transaction->user_id)->get()->first();
                                                                @endphp
                                                                <div class="row col-12">
                                                                    <div class="col-3">
                                                                        <p>{{$bank->account_no}}</p>
                                                                    </div>
                                                                    <div class="col-3">
                                                                        <p>{{$bank->bank_name}}</p>
                                                                    </div>
                                                                    <div class="col-3">
                                                                        <p>{{$bank->branch_name}}</p>
                                                                    </div>
                                                                    <div class="col-3">
                                                                        <p>{{$bank->ifsc_code}}</p>
                                                                    </div>
                                                                </div>
                                                                <!-- Account Details -->
                                                                <!-- Order Details -->
                                                                <div class="row pt-3 col-12">
                                                                    <h5>
                                                                        <span class="pl-3"><u>Order Details</u></span>:-
                                                                    </h5>
                                                                </div>
                                                                <div class="row col-12">

                                                                    <div class="col-3">
                                                                        <h6 class="">Order Id</h6>
                                                                    </div>
                                                                    <div class="col-3">
                                                                        <h6 class="">Amount</h6>
                                                                    </div>
                                                                    <div class="col-3">
                                                                        <h6 class="">Order Status</h6>
                                                                    </div>
                                                                </div>
                                                                @php
                                                                $order=\App\Order::find($member_transaction->order_id);
                                                                $client=\App\User::find($order->user_id);
                                                                @endphp
                                                                @if(!empty($order))
                                                                <div class="row col-12">
                                                                    <div class="col-3">
                                                                        <p>{{$order->id}}</p>
                                                                    </div>
                                                                    <div class="col-3">
                                                                        <p>{{$order->amount}}</p>
                                                                    </div>
                                                                    <div class="col-3">
                                                                        <p class="badge badge-info">{{$order->order_status}}</p>
                                                                    </div>
                                                                </div>
                                                                @endif
                                                                <!-- Order Details -->
                                                                
                                                                <!-- User Details -->
                                                                <div class="row pt-3 col-12">
                                                                    <h5>
                                                                        <span class="pl-3"><u>Client Details</u></span>:-
                                                                    </h5>
                                                                </div>
                                                                <div class="row col-12">

                                                                    <div class="col-3">
                                                                        <h6 class="">User Name</h6>
                                                                    </div>
                                                                    <div class="col-3">
                                                                        <h6 class="">Mobile Number</h6>
                                                                    </div>
                                                                    <div class="col-3">
                                                                        <h6 class="">Email</h6>
                                                                    </div>
                                                                </div>
                                                                @php
                                                                $order=\App\Order::find($member_transaction->order_id);
                                                                $client=\App\User::find($order->user_id);
                                                                @endphp
                                                                @if(!empty($client))
                                                                <div class="row col-12">
                                                                    <div class="col-3">
                                                                        <p>{{$client->name}}</p>
                                                                    </div>
                                                                    <div class="col-3">
                                                                        <p>{{$client->phone}}</p>
                                                                    </div>
                                                                    <div class="col-3">
                                                                        <p>{{$client->email}}</p>
                                                                    </div>
                                                                </div>
                                                                @endif
                                                                <!-- User Details -->
                                                                
                                                                
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--Bank Details-->
                                            <br>
                                            @if($member_transaction->status == 'Pending')
                                            <a href="{{route('member_transaction.show',$member_transaction->id)}}"><button type="button" class="btn btn-warning btn-round waves-effect waves-light m-1">Pay Now</button></a>
                                            @endif


                                        </td>
                                    </tr>
                                </a>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Transaction Id</th>
                                    <th>Name</th>
                                    <th>User Type</th>
                                    <th>Amount</th>
                                    <th>Payment Status</th>
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