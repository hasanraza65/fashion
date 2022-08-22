@extends('layouts.manufacturer')

@section('content')

    <div class="container-fluid">
        <!-- Breadcrumb-->
        <div class="row pt-2 pb-2">
            <div class="col-sm-12">
                <h4 class="page-title">{{$title}}</h4>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('manufacturer-web.index')}}">{{$title}}</a></li>
                </ol>
            </div>
        </div>
        <!-- End Breadcrumb-->
        <div class="row">
       
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