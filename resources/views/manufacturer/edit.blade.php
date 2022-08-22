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
                <div class="card-body">
                    <div class="card-title">Edit Profile</div>
                    <hr>
                    <form method="POST" action="{{route('manufacturer-web.update',$users->id)}}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="form-group row">
                            <label for="input-21" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="input-21" placeholder="Enter Your Name" name="name" value="{{ $users->name }}" required autocomplete="name" autofocus>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <input type="hidden" value="{{$users->id}}" name="id">
                        <div class="form-group row">
                            <label for="input-22" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" id="input-22" placeholder="Enter Your Email Address" name="email" value="{{$users->email}}" required autocomplete="email">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-23" class="col-sm-2 col-form-label">Mobile</label>
                            <div class="col-sm-10">
                                <input type="phone" class="form-control" id="input-23" placeholder="Enter Your Mobile Number" name="phone" value="{{ $users->phone }}" required autocomplete="phone">
                                @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        @php
                        $manufacturer_details=\App\Manufacturer_detail::where('user_id',$users->id)->get()->first();
                        @endphp
                        <div class="form-group row">
                            <label for="input-23" class="col-sm-2 col-form-label">Adhar Number</label>
                            <div class="col-sm-10">
                                <input type="phone" class="form-control" id="input-23" placeholder="Enter Your Adhar Number" name="adhar_no" value="{{ $manufacturer_details->adhar_no }}" required autocomplete="">
                              
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label"> Select Adhar Image</label>
                            <div class=col-sm-10">
                                &nbsp; &nbsp; <input type="file" name="adhar_image" />
                                <a href="{{ $manufacturer_details->adhar_pic }}" data-fancybox>
                                    <img src="{{ $manufacturer_details->adhar_pic }}" class="img-thumbnail" width="100" />
                                </a>

                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label"> Select Avatar Image</label>
                            <div class=col-sm-10">
                                &nbsp; &nbsp; <input type="file" name="image" />
                                <a href="{{ $users->avatar }}" data-fancybox>
                                    <img src="{{ $users->avatar }}" class="img-thumbnail" width="100" />
                                </a>

                            </div>
                        </div>
                        <div class="card-title">Edit Bank Details</div>
                        @php
                        $bank_details=\App\Bank_detail::where('user_id',$users->id)->get()->first();
                        $manufacturer_details=\App\Manufacturer_detail::where('user_id',$users->id)->get()->first();
                        @endphp
                        <div class="form-group row">
                            <label for="input-23" class="col-sm-2 col-form-label">Bank Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="input-23" placeholder="Enter Your Bank Name " name="bank_name" value="{{ $bank_details->bank_name }}" required autocomplete="phone">

                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-23" class="col-sm-2 col-form-label">Account Number</label>
                            <div class="col-sm-10">
                                <input type="phone" class="form-control" id="input-23" placeholder="Enter Your Account Number" name="account_no" value="{{ $bank_details->account_no }}" required autocomplete="phone">

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="input-23" class="col-sm-2 col-form-label">Branch Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="input-23" placeholder="Enter Your Branch Name " name="branch_name" value="{{ $bank_details->branch_name }}" required autocomplete="phone">

                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-23" class="col-sm-2 col-form-label">IFSC Code</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="input-23" placeholder="Enter Your IFSC Code " name="ifsc_code" value="{{ $bank_details->ifsc_code }}" required autocomplete="phone">

                            </div>
                        </div>


                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10">
                        <div class="icheck-material-primary">

                        </div>
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