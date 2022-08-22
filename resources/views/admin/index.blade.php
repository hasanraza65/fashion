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
                                    <a href="{{route('admin.create')}}" class="btn btn-success waves-effect waves-light m-1" style="float: right;">Add New</a>
                                </div>
            <div class="card-header"><i class="fa fa-table"></i> All Admins</div>
            <div class="card-body">
              <div class="table-responsive">
              <table id="example" class="table table-bordered">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                       
                    </tr>
                </thead>
                <tbody>
                    @foreach($admins as $admin)
                    <tr>
                    <td>{{$admin->id}}</td>                       
                    <td>{{$admin->name}}</td>                       
                    <td>{{$admin->email}}</td>                       
                    <td>{{$admin->phone}}</td>                       
                    </tr>
                   @endforeach
                </tbody>
                <tfoot>
                    <tr>
                    <th>Id</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        
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