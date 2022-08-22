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
                <a href="{{route('manufacturer.create')}}" class="btn btn-success waves-effect waves-light m-1" style="float: right;">Add New</a>

                </div>
                <div class="card-header"><i class="fa fa-table"></i> {{$title}}</div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Percentage</th>
                                    <th>Adhar No</th>
                                    <th>Adhar Picture</th>
                                    <th>Is Approved</th>
                                    <th>Action</th>


                                </tr>
                            </thead>
                            <tbody>
                                @foreach($manufacturers as $manufacturer)
                                <tr>
                                    <td>{{$manufacturer->name}}</td>
                                    <td>{{$manufacturer->email}}</td>
                                    <td>{{$manufacturer->phone}}</td>
                                    @php
                                    $manufacturer_details=\App\Manufacturer_detail::where('user_id',$manufacturer->id)->get()->first();
                                    @endphp
                                    <td>{{$manufacturer_details->percentage}}%</td>
                                    <td>{{$manufacturer_details->adhar_no}}</td>
                                    <td><a href="{{ $manufacturer_details->adhar_pic }}" data-fancybox>
                                            <img src="{{ $manufacturer_details->adhar_pic }}" class="img-thumbnail" width="200" />
                                        </a></td>
                                    <td>
                                        @if($manufacturer->is_approved)
                                        <span class="badge badge-pill badge-success shadow-success m-1">Approved</span>
                                        @else
                                        <span class="badge badge-pill badge-warning shadow-warning m-1">Not Approved</span>
                                        @endif

                                    </td>
                                    <td>
                                        @if($manufacturer->is_approved)

                                        <a href="{{route('manufacturer.edit',$manufacturer->id)}}"><button type="button" class="btn btn-danger btn-round waves-effect waves-light m-1">Disapprove</button></a>
                                        @else
                                        <!-- <form action="{{route('manufacturer.update',$manufacturer->id)}}" method="post">
                                            @csrf
                                            @method('PUT')
                                            <input type='hidden' value="5" name="percentage">
                                            <button type="submit" name="submit" class="btn btn-success btn-round waves-effect waves-light m-1">Approve</button>
                                        </form> -->
                                        <button class="btn btn-primary btn-block m-1" data-toggle="modal" data-target="#formemodal_{{$manufacturer->id}}">Approve</button>
                                        <div class="modal fade" id="formemodal_{{$manufacturer->id}}">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Update Details</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{route('manufacturer.update',$manufacturer->id)}}" method="post">
                                                            @csrf
                                                            @method('PUT')
                                            
                                                            <div class="form-group">
                                                                <label for="input-1">percentage</label>
                                                                <input type="text" class="form-control" name="percentage" id="input-1" value="{{$manufacturer_details->percentage}}" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <button type="submit" class="btn btn-primary px-5"><i class="icon-lock"></i> Update</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Percentage</th>
                                    <th>Adhar No</th>
                                    <th>Adhar Picture</th>
                                    <th>Is Approved</th>
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