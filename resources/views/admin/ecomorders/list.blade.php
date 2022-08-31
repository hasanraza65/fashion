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
                <div class="card-header">

                </div>
                <div class="card-header"><i class="fa fa-table"></i> {{$title}}</div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Payment Status</th>
                                    <th>Buyer</th>
                                    <th>Delivery Status</th>
                                    <th>Manage Items</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $orderss)
                                <tr>
                                   
                                    <td>{{$orderss->id}}</td>
                                    <td>{{$orderss->payment_status}}</td>
                                    <td>{{\App\User::findOrFail($orderss->buyer_id)->name}}</td>
                                    <td>{{$orderss->delivery_status}}</td>
                                    <td><a href="/manage_order_items/{{$orderss->id}}" class="btn btn-primary">Manage Order Items</a></td>
                                    <td>
                                        <a href="{{route('shoporders.edit',$orderss->id)}}"><button type="button" class="btn btn-success btn-round waves-effect waves-light m-1">Edit</button></a>
                                        <form action="{{route('shoporders.destroy',$orderss->id)}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button onclick="return confirm('Are you sure?')" type="submit" name="submit" class="btn btn-danger btn-round waves-effect waves-light m-1">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>Payment Status</th>
                                    <th>Buyer</th>
                                    <th>Delivery Status</th>
                                    <th>Manage Items</th>
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