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
                                    <th>Client Name</th>
                                    <th>Amount</th>
                                    <th>Status</th>


                                </tr>
                            </thead>
                            <tbody>
                                @foreach($member_transactions as $member_transaction)
                                <a href="#">
                                    <tr>

                                        <td>{{$member_transaction->id}}</td>
                                        @php
                                        $order=\App\Order::find($member_transaction->order_id);
                                        $user=\App\User::find($order->user_id);
                                        
                                        @endphp
                                        <td>{{$user->name}}</td>
                                        

                                        <td>{{$member_transaction->amount}}</td>

                                        <td>
                                            @if($member_transaction->status == 'pending')
                                            <span class="badge badge-pill badge-warning shadow-warning m-1">Pending</span>

                                            @else
                                            <span class="badge badge-pill badge-success shadow-success m-1">Paid</span>

                                            @endif

                                        </td>
                                       
                                    </tr>
                                </a>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Transaction Id</th>
                                    <th>Client Name</th>
                                    <th>Amount</th>
                                    <th>Payment Status</th>

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