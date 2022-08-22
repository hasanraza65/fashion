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
                <a href="{{route('manufacturing_cost.create')}}" class="btn btn-success waves-effect waves-light m-1" style="float: right;">Add New</a>

                </div>
                <div class="card-header"><i class="fa fa-table"></i> {{$title}}</div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Style No</th>
                                    <th>Style Name</th>
                                    <th>Manufacturing Cost</th>
                                    <th>Action</th>


                                </tr>
                            </thead>
                            <tbody>
                                @foreach($manufacturing_costs as $manufacturing_cost)
                                <tr>
                                    <td>{{$manufacturing_cost->style_no}}</td>
                                    <td>{{$manufacturing_cost->style_name}}</td>

                                    <td>{{$manufacturing_cost->manufacturing_cost}}</td>

                                    <td>

                                        <a href="{{route('manufacturing_cost.edit',$manufacturing_cost->id)}}"><button type="button" class="btn btn-success btn-round waves-effect waves-light m-1">Edit</button></a>
                                        <form action="{{route('manufacturing_cost.destroy',$manufacturing_cost->id)}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" name="submit" class="btn btn-danger btn-round waves-effect waves-light m-1">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                <th>Style No</th>
                                    <th>Style Name</th>
                                    <th>Manufacturing Cost</th>
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