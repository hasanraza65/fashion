<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8"/>
<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
<meta name="description" content=""/>
<meta name="author" content=""/>
<title>{{$title}}</title>
<!--favicon-->
<link rel="icon" href="{{asset('theme/assets/images/favicon.png')}}" sizes="16x16" type="image/png">
<!-- Vector CSS -->
<link href="{{asset('theme/assets/plugins/vectormap/jquery-jvectormap-2.0.2.css')}}" rel="stylesheet"/>
<!-- simplebar CSS-->
<link href="{{asset('theme/assets/plugins/simplebar/css/simplebar.css')}}" rel="stylesheet"/>
<!-- Bootstrap core CSS-->
<link href="{{asset('theme/assets/css/bootstrap.min.css')}}" rel="stylesheet"/>

<!-- animate CSS-->
<link href="{{asset('theme/assets/css/animate.css')}}" rel="stylesheet" type="text/css"/>
<!-- Icons CSS-->
<link href="{{asset('theme/assets/css/icons.css')}}" rel="stylesheet" type="text/css"/>
<!-- Sidebar CSS-->
<link href="{{asset('theme/assets/css/sidebar-menu.css')}}" rel="stylesheet"/>
<!-- Custom Style-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css" integrity="sha512-H9jrZiiopUdsLpg94A333EfumgUBpO9MdbxStdeITo+KEIMaNfHNvwyjjDJb+ERPaRS6DpyRlKbvPUasNItRyw==" crossorigin="anonymous" />
<link href="{{asset('theme/assets/plugins/bootstrap-datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('theme/assets/plugins/bootstrap-datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css">




<link href="{{asset('theme/assets/css/app-style.css')}}" rel="stylesheet"/>
<link href="{{asset('theme/assets/sweetalert/sweetalert.css')}}" rel="stylesheet"/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>
    <body>
        <!-- start loader -->
        <div id="pageloader-overlay" class="visible incoming">
            <div class="loader-wrapper-outer">
                <div class="loader-wrapper-inner" >
                    <div class="loader"></div>
                </div>
            </div>
        </div>
        <!-- end loader -->
        <!-- Start wrapper-->
        <div id="wrapper">
        <div id="sidebar-wrapper" class="bg-theme bg-theme2" data-simplebar="" data-simplebar-auto-hide="true">
    <div class="brand-logo">
        <a href="{{ route('home') }}">
            <img src="{{asset('theme/assets/images/logo-icon.png')}}" class="logo-icon" alt="logo icon">
            <h5 class="logo-text">Fashion Admin</h5>
        </a>
    </div>
    <div class="user-details">
        <div class="media align-items-center user-pointer collapsed" data-toggle="collapse" data-target="#user-dropdown">
            @if(Auth::user()->avatar)
            <div class="avatar"><img class="mr-3 side-user-img" src="{{ Auth::user()->avatar }}" alt="user avatar"></div>

            @else
            <div class="avatar"><img class="mr-3 side-user-img" src="{{asset('theme/assets/images/avatars/avatar-2.png')}}" alt="user avatar"></div>

            @endif
            <div class="media-body">
                <h6 class="side-user-name">{{ Auth::user()->name }} </h6>
            </div>
        </div>
        <div id="user-dropdown" class="collapse">
            <ul class="user-setting-menu">
            <li><a href="{{route('admin.edit',Auth::user()->id)}}"><i class="icon-settings"></i> Setting</a></li>
            <li><a href="{{route('change.password')}}"><i class="icon-settings"></i> Change Password</a></li>
                <li>
                  <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form1').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form1" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>    

                </li>
            </ul>
        </div>
        
        
    </div>
    <ul class="sidebar-menu do-nicescrol">
        <li class="sidebar-header"></li>
        <li>
<!--        <li>
            <a href="javaScript:void();" class="waves-effect">
                <i class="zmdi zmdi-view-dashboard"></i> <span>Account Setting</span><i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="sidebar-submenu">
                <li><a href="#"><i class="zmdi zmdi-long-arrow-right"></i> Profile</a></li>
                <li><a href="#"><i class="zmdi zmdi-long-arrow-right"></i> Password</a></li>
            </ul>
        </li>-->
        <li>
            <a href="javaScript:void();" class="waves-effect">
                <i class="zmdi zmdi-view-dashboard"></i> <span>Administrator</span><i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="sidebar-submenu">
                <li><a href="{{route('admin.create')}}"><i class="zmdi zmdi-long-arrow-right"></i>Add Admin</a></li>
                <li><a href="{{route('admin.index')}}"><i class="zmdi zmdi-long-arrow-right"></i> View Admin</a></li>
            </ul>
        </li>

        <li>
            <a href="javaScript:void();" class="waves-effect">
                <i class="zmdi zmdi-view-dashboard"></i> <span>Products</span><i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="sidebar-submenu">
                <li><a href="{{route('products.create')}}"><i class="zmdi zmdi-long-arrow-right"></i>Add Product</a></li>
                <li><a href="{{route('products.index')}}"><i class="zmdi zmdi-long-arrow-right"></i> View Products</a></li>
            </ul>
        </li>
        <li>
            <a href="javaScript:void();" class="waves-effect">
                <i class="zmdi zmdi-view-dashboard"></i> <span>Product Categories</span><i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="sidebar-submenu">
                <li><a href="{{route('productcategories.create')}}"><i class="zmdi zmdi-long-arrow-right"></i>Add Category</a></li>
                <li><a href="{{route('productcategories.index')}}"><i class="zmdi zmdi-long-arrow-right"></i> View Category</a></li>
            </ul>
        </li>

        <li>
            <a href="javaScript:void();" class="waves-effect">
                <i class="zmdi zmdi-view-dashboard"></i> <span>Banners</span><i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="sidebar-submenu">
                <li><a href="{{route('banner.create')}}"><i class="zmdi zmdi-long-arrow-right"></i>Add Banner</a></li>
                <li><a href="{{route('banner.index')}}"><i class="zmdi zmdi-long-arrow-right"></i> View Banners</a></li>
            </ul>
        </li>
        

        <li>
            <a href="javaScript:void();" class="waves-effect">
                <i class="zmdi zmdi-view-dashboard"></i> <span>Fabrics</span><i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="sidebar-submenu">
                <li><a href="{{route('fabric.create')}}"><i class="zmdi zmdi-long-arrow-right"></i>Add Fabric</a></li>
                <li><a href="{{route('fabric.index')}}"><i class="zmdi zmdi-long-arrow-right"></i> View Fabric</a></li>
            </ul>
        </li>

        <li>
            <a href="javaScript:void();" class="waves-effect">
                <i class="zmdi zmdi-view-dashboard"></i> <span>Trims</span><i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="sidebar-submenu">
                <li><a href="{{route('extra.create')}}"><i class="zmdi zmdi-long-arrow-right"></i>Add Trim</a></li>
                <li><a href="{{route('extra.index')}}"><i class="zmdi zmdi-long-arrow-right"></i> View Trims</a></li>
            </ul>
        </li>

        <li>
            <a href="javaScript:void();" class="waves-effect">
                <i class="zmdi zmdi-view-dashboard"></i> <span>Styles</span><i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="sidebar-submenu">
                <li><a href="{{route('manufacturing_cost.create')}}"><i class="zmdi zmdi-long-arrow-right"></i>Add Style</a></li>
                <li><a href="{{route('manufacturing_cost.index')}}"><i class="zmdi zmdi-long-arrow-right"></i> View Styles</a></li>
            </ul>
        </li>

        <li>
            <a href="javaScript:void();" class="waves-effect">
                <i class="zmdi zmdi-view-dashboard"></i> <span>Catlog Categories</span><i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="sidebar-submenu">
                <li><a href="{{route('cat.create')}}"><i class="zmdi zmdi-long-arrow-right"></i>Add Category</a></li>
                <li><a href="{{route('cat.index')}}"><i class="zmdi zmdi-long-arrow-right"></i> View Category</a></li>
            </ul>
        </li>

        <li>
            <a href="javaScript:void();" class="waves-effect">
                <i class="zmdi zmdi-view-dashboard"></i> <span>Designers</span><i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="sidebar-submenu">
                <li><a href="{{route('designer.index')}}"><i class="zmdi zmdi-long-arrow-right"></i> View Designers</a></li>
            </ul>
        </li>
        <li>
        
        <li>
            <a href="javaScript:void();" class="waves-effect">
                <i class="zmdi zmdi-view-dashboard"></i> <span>Manufacturers</span><i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="sidebar-submenu">
            <li><a href="{{route('manufacturer.create')}}"><i class="zmdi zmdi-long-arrow-right"></i> Add Manufacturers</a></li>
            <li><a href="{{route('manufacturer.index')}}"><i class="zmdi zmdi-long-arrow-right"></i> View Manufacturers</a></li>
            </ul>
        </li>
        <li>
            
            <a href="javaScript:void();" class="waves-effect">
                <i class="zmdi zmdi-view-dashboard"></i> <span>Orders</span><i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="sidebar-submenu">
                <li><a href="{{route('order.index')}}"><i class="zmdi zmdi-long-arrow-right"></i> View Orders</a></li>
            </ul>
        </li>
        <li>
            
            <a href="javaScript:void();" class="waves-effect">
                <i class="zmdi zmdi-view-dashboard"></i> <span>User Transaction</span><i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="sidebar-submenu">
                <li><a href="{{route('transaction.index')}}"><i class="zmdi zmdi-long-arrow-right"></i> View Transactions</a></li>
            </ul>
        </li>

        <li>
            
            <a href="javaScript:void();" class="waves-effect">
                <i class="zmdi zmdi-view-dashboard"></i> <span>Member Transaction</span><i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="sidebar-submenu">
                <li><a href="{{route('member_transaction.index')}}"><i class="zmdi zmdi-long-arrow-right"></i> View Transactions</a></li>
            </ul>
        </li>
       
        <!-- <li>
            <a href="javaScript:void();" class="waves-effect">
                <i class="zmdi zmdi-view-dashboard"></i> <span>Shop</span><i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="sidebar-submenu">
                <li><a href="add-shop.php"><i class="zmdi zmdi-long-arrow-right"></i>Add Shop</a></li>
                <li><a href="view-shop.php"><i class="zmdi zmdi-long-arrow-right"></i> View Shop</a></li>
            </ul>
        </li> -->
        
    </ul>

</div>
<header class="topbar-nav">
<nav class="navbar navbar-expand fixed-top">
                    <ul class="navbar-nav mr-auto align-items-center">
                        <li class="nav-item">
                            <a class="nav-link toggle-menu" href="javascript:void();">
                                <i class="icon-menu menu-icon"></i>
                            </a>
                        </li>
                        <!-- <li class="nav-item">
                            <form class="search-bar">
                                <input type="text" class="form-control" placeholder="Enter keywords">
                                <a href="javascript:void();"><i class="icon-magnifier"></i></a>
                            </form>
                        </li> -->
                    </ul>

                    <ul class="navbar-nav align-items-center right-nav-link">
<!--                        <li class="nav-item dropdown-lg">
                            <a class="nav-link dropdown-toggle dropdown-toggle-nocaret waves-effect" data-toggle="dropdown" href="javascript:void();">
                                <i class="fa fa-envelope-open-o"></i><span class="badge badge-light badge-up">12</span></a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        You have 12 new messages
                                        <span class="badge badge-light">12</span>
                                    </li>
                                    <li class="list-group-item">
                                        <a href="javaScript:void();">
                                            <div class="media">
                                                <div class="avatar"><img class="align-self-start mr-3" src="assets/images/avatars/avatar-5.png" alt="user avatar"></div>
                                                <div class="media-body">
                                                    <h6 class="mt-0 msg-title">Jhon Deo</h6>
                                                    <p class="msg-info">Lorem ipsum dolor sit amet...</p>
                                                    <small>Today, 4:10 PM</small>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="list-group-item">
                                        <a href="javaScript:void();">
                                            <div class="media">
                                                <div class="avatar"><img class="align-self-start mr-3" src="assets/images/avatars/avatar-6.png" alt="user avatar"></div>
                                                <div class="media-body">
                                                    <h6 class="mt-0 msg-title">Sara Jen</h6>
                                                    <p class="msg-info">Lorem ipsum dolor sit amet...</p>
                                                    <small>Yesterday, 8:30 AM</small>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="list-group-item">
                                        <a href="javaScript:void();">
                                            <div class="media">
                                                <div class="avatar"><img class="align-self-start mr-3" src="assets/images/avatars/avatar-7.png" alt="user avatar"></div>
                                                <div class="media-body">
                                                    <h6 class="mt-0 msg-title">Dannish Josh</h6>
                                                    <p class="msg-info">Lorem ipsum dolor sit amet...</p>
                                                    <small>5/11/2018, 2:50 PM</small>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="list-group-item">
                                        <a href="javaScript:void();">
                                            <div class="media">
                                                <div class="avatar"><img class="align-self-start mr-3" src="assets/images/avatars/avatar-8.png" alt="user avatar"></div>
                                                <div class="media-body">
                                                    <h6 class="mt-0 msg-title">Katrina Mccoy</h6>
                                                    <p class="msg-info">Lorem ipsum dolor sit amet.</p>
                                                    <small>1/11/2018, 2:50 PM</small>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="list-group-item text-center"><a href="javaScript:void();">See All Messages</a></li>
                                </ul>
                            </div>
                        </li>-->
                        
                       <li class="nav-item">
                            <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" data-toggle="dropdown" href="#">
                            @if(Auth::user()->avatar)
            <span class="user-profile"><img src="{{ Auth::user()->avatar }}" class="img-circle" alt="user avatar"></span>

            @else
            <span class="user-profile"><img src="{{asset('theme/assets/images/avatars/avatar-2.png')}}" class="img-circle" alt="user avatar"></span>

            @endif
                            </a>
                            <ul class="dropdown-menu dropdown-menu-right">
                                <li class="dropdown-item user-details">
                                    <a href="javaScript:void();">
                                        <div class="media">
                                        @if(Auth::user()->avatar)

                                        <div class="avatar"><img class="align-self-start mr-3" src="{{ Auth::user()->avatar }}" alt="user avatar"></div>
                                        @else
                                        <div class="avatar"><img class="align-self-start mr-3" src="{{asset('theme/assets/images/avatars/avatar-2.png')}}" alt="user avatar"></div>
                                        @endif
                                        <div class="media-body">
                                                <h6 class="mt-2 user-title">{{ Auth::user()->name }} </h6>
                                                <p class="user-subtitle">{{ Auth::user()->email }} </p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="dropdown-divider"></li>
                                <li class="dropdown-divider"></li>
                                <li class="dropdown-divider"></li>
                                <li class="dropdown-item"><a href="{{route('admin.edit',Auth::user()->id)}}"><i class="icon-settings mr-2"></i> Setting</a></li>
                                <li class="dropdown-item"><a href="{{route('change.password')}}"><i class="icon-settings mr-2"></i> Change Password</a></li>

                                <li class="dropdown-divider"></li>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>                            </ul>
                        </li>
                    </ul>
                </nav>
            </header>


            <div class="clearfix"> 


</div>
<div class="content-wrapper">

@if ($errors->any())
     @foreach ($errors->all() as $error)
     <div class="alert alert-danger alert-dismissible" role="alert" style="">
			<button type="button" class="close" data-dismiss="alert">×</button>
			<div class="alert-icon">
			 <i class="fa fa-times"></i>
			</div>
			<div class="alert-message">
			  <span><strong>Alert!</strong>{{$error}}</span>
			</div>
		  </div>     @endforeach
 @endif

 @if(session()->has('success'))
     <div class="alert alert-success alert-dismissible" role="alert" style="">
			<button type="button" class="close" data-dismiss="alert">×</button>
			<div class="alert-icon">
			 <i class="fa fa-check"></i>
			</div>
			<div class="alert-message">
			  <span><strong>Success!</strong>{{session()->get('success')}}</span>
			</div>
		  </div>     
 @endif
@yield('content')
<footer class="footer" style="position:fixed">

            <div class="container">
                    <div class="text-center">
                        Copyright © 2020 Fashion Design & Developed By <a href="https://infikeytech.com/">Infikey Technologies Pvt Ltd.</a>
                    </div>
                </div>
</footer>
                <!--End footer-->
            <!--start color switcher-->
            <!--end color cwitcher-->
        </div><!--End wrapper-->
        <script src="{{asset('theme/assets/js/jquery.min.js')}}"></script>
<script src="{{asset('theme/assets/js/popper.min.js')}}"></script>
<script src="{{asset('theme/assets/js/bootstrap.min.js')}}"></script>
<!-- Bootstrap core JavaScript-->
        <script src="{{asset('theme/assets/plugins/bootstrap-datatable/js/jquery.dataTables.min.js')}}"></script>
        <script src="{{asset('theme/assets/plugins/bootstrap-datatable/js/dataTables.bootstrap4.min.js')}}"></script>
        <script src="{{asset('theme/assets/plugins/bootstrap-datatable/js/dataTables.buttons.min.js')}}"></script>
        <script src="{{asset('theme/assets/plugins/bootstrap-datatable/js/buttons.bootstrap4.min.js')}}"></script>
        <script src="{{asset('theme/assets/plugins/bootstrap-datatable/js/jszip.min.js')}}"></script>
        <script src="{{asset('theme/assets/plugins/bootstrap-datatable/js/pdfmake.min.js')}}"></script>
        <script src="{{asset('theme/assets/plugins/bootstrap-datatable/js/vfs_fonts.js')}}"></script>
        <script src="{{asset('theme/assets/plugins/bootstrap-datatable/js/buttons.html5.min.js')}}"></script>
        <script src="{{asset('theme/assets/plugins/bootstrap-datatable/js/buttons.print.min.js')}}"></script>
        <script src="{{asset('theme/assets/plugins/bootstrap-datatable/js/buttons.colVis.min.js')}}"></script>









<!-- simplebar js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js" integrity="sha512-uURl+ZXMBrF4AwGaWmEetzrd+J5/8NRkWAvJx5sbPSSuOb0bZLqf+tOzniObO00BjHa/dD7gub9oCGMLPQHtQA==" crossorigin="anonymous"></script>

<script src="{{asset('theme/assets/plugins/simplebar/js/simplebar.js')}}"></script>
<!-- sidebar-menu js -->
<script src="{{asset('theme/assets/js/sidebar-menu.js')}}"></script>
<!-- Custom scripts -->
<script src="{{asset('theme/assets/js/app-script.js')}}"></script>
<!-- Chart js -->
<!--<script src="assets/plugins/alerts-boxes/js/sweetalert.min.js"></script>
<script src="assets/plugins/alerts-boxes/js/sweet-alert-script.js"></script>-->
<!--Sweet Alerts -->
<script src="{{asset('theme/assets/sweetalert/sweetalert.js')}}"></script>
<!--Sweet Alerts Function-->
<script>
// $(document).ready(function(){
//    var href = window.location.href,
//        newUrl = href.substring(0, href.indexOf('?'))
//    window.history.replaceState({}, '', newUrl);
// });
    
    $(document).ready(function() {
      //Default data table
       $('#default-datatable').DataTable();


       var table = $('#example').DataTable( {
        lengthChange: false,
        buttons: [ 'copy', 'excel', 'pdf', 'print', 'colvis' ]
      } );
 
     table.buttons().container()
        .appendTo( '#example_wrapper .col-md-6:eq(0)' );
      
      } );

    

//    php sweet alert function call 


</script>
</body>
</html>