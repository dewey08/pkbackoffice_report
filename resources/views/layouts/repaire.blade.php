<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('title')</title>
   <!-- Font Awesome -->
   <link href="{{ asset('assets/fontawesome/css/all.css') }}" rel="stylesheet">
   <!-- App favicon -->
   <link rel="shortcut icon" href="{{ asset('pkclaim/images/logo150.ico') }}">

   

   {{-- <link href="{{ asset('assets/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css"> --}}
   <link href="{{ asset('pkclaim/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet">
   <link href="{{ asset('pkclaim/libs/spectrum-colorpicker2/spectrum.min.css') }}" rel="stylesheet" type="text/css">
   <link href="{{ asset('pkclaim/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css') }}" rel="stylesheet">
   <!-- jquery.vectormap css -->
   <link href="{{ asset('pkclaim/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css') }}"
       rel="stylesheet" type="text/css" />

   <!-- DataTables -->
   <link href="{{ asset('pkclaim/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet"
       type="text/css" />

   <!-- Responsive datatable examples -->
   <link href="{{ asset('pkclaim/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}"
       rel="stylesheet" type="text/css" />
       <link href="{{ asset('css/tablerepaire.css') }}" rel="stylesheet">
   <!-- Bootstrap Css -->
   <link href="{{ asset('bt52/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
   {{-- <link href="{{ asset('pkclaim/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" /> --}}
   <!-- Icons Css -->
   <link href="{{ asset('pkclaim/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
   <!-- App Css-->
   <link href="{{ asset('pkclaim/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
   {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" /> --}}
   <link href="{{ asset('css/fullcalendar.css') }}" rel="stylesheet">
   {{-- <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet"> --}}
    <!-- select2 -->
    <link rel="stylesheet" href="{{asset('asset/js/plugins/select2/css/select2.min.css')}}">
   <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </head>
    <style>
        body {
            font-family: 'Kanit', sans-serif;
            font-size: 13px;
    
        }
    
        label {
            font-family: 'Kanit', sans-serif;
            font-size: 14px;
    
        }
    
        @media only screen and (min-width: 1200px) {
            label {
                /* float:right; */
            }
    
        }
    
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }
    
        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    
        .b-example-divider {
            height: 3rem;
            background-color: rgba(0, 0, 0, .1);
            border: solid rgba(0, 0, 0, .15);
            border-width: 1px 0;
            box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
        }
    
        .b-example-vr {
            flex-shrink: 0;
            width: 1.5rem;
            height: 100vh;
        }
    
        .bi {
            vertical-align: -.125em;
            fill: currentColor;
        }
    
        .nav-scroller {
            position: relative;
            z-index: 2;
            height: 2.75rem;
            overflow-y: hidden;
        }
    
        .nav-scroller .nav {
            display: flex;
            flex-wrap: nowrap;
            padding-bottom: 1rem;
            margin-top: -1px;
            overflow-x: auto;
            text-align: center;
            white-space: nowrap;
            -webkit-overflow-scrolling: touch;
        }
    
        .dataTables_wrapper .dataTables_filter {
            float: right
        }
    
        .dataTables_wrapper .dataTables_length {
            float: left
        }
    
        .dataTables_info {
            float: left;
        }
    
        .dataTables_paginate {
            float: right
        }
    
        .custom-tooltip {
            --bs-tooltip-bg: var(--bs-primary);
    
    
        }
    
        .table thead tr th {
            font-size: 14px;
        }
    
        .table tbody tr td {
            font-size: 13px;
        }
    
        .menu {
            font-size: 13px;
        }
    </style>
    <body data-topbar="light" data-layout="horizontal">

         <!-- Loader -->
    <div id="preloader">
        <div id="status">
            <div class="spinner">
                <i class="ri-loader-line spin-icon"></i>
            </div>
        </div>
    </div>

        <!-- Begin page -->
        <div id="layout-wrapper">
            {{-- style="background-color: rgba(79, 83, 83, 0.952)" --}}
            <header id="page-topbar" >
                <div class="navbar-header">
                    <div class="d-flex">
                        <!-- LOGO -->
                        <div class="navbar-brand-box">                       
                        </div>
                        <button type="button" class="btn btn-sm px-3 font-size-24 d-lg-none header-item"
                            data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
                            <i class="ri-menu-2-line align-middle"></i>
                        </button>
    
                        <div class="dropdown dropdown-mega d-none d-lg-block ">
                            <img src="{{ asset('pkclaim/images/logo150.png') }}" alt="logo-sm-light" height="40">
                            <button type="button" class="btn header-item waves-effect" data-bs-toggle="dropdown"
                                aria-haspopup="false" aria-expanded="false">
                                <h4 style="color:rgb(109, 14, 172)" class="mt-3">PK-BACKOFFice</h4>
    
                            </button>
                        </div>
    
                    </div>
                    <?php  
                            $datadetail = DB::connection('mysql')->select(                                                            '   
                                    select * from orginfo 
                                    where orginfo_id = 1                                                                                                                      ',
                            ); 
                        ?>
                        {{-- <button type="button" class="btn btn-sm px-3 font-size-24 d-lg-none header-item" data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
                            <i class="ri-menu-2-line align-middle" style="color: rgb(255, 255, 255)"></i>
                        </button>                         --}}
                    {{-- </div> --}}

                    <div class="d-flex">                      
                        <div class="dropdown d-none d-lg-inline-block ms-1">
                            <button type="button" class="btn header-item noti-icon waves-effect" data-toggle="fullscreen">
                                <i class="ri-fullscreen-line" style="color: rgb(170, 7, 97)"></i>
                            </button>
                        </div>
    
                        <div class="dropdown d-inline-block">
                            <button type="button" class="btn header-item noti-icon waves-effect"
                                id="page-header-notifications-dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="ri-notification-3-line"></i>
                                <span class="noti-dot"></span>
                            </button>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                                aria-labelledby="page-header-notifications-dropdown">
                                <div class="p-3">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <h6 class="m-0"> Notifications </h6>
                                        </div>
                                        <div class="col-auto">
                                            <a href="#!" class="small"> View All</a>
                                        </div>
                                    </div>
                                </div>
                                <div data-simplebar style="max-height: 230px;">
                                    <a href="" class="text-reset notification-item">
                                        <div class="d-flex">
                                            <div class="avatar-xs me-3">
                                                <span class="avatar-title bg-primary rounded-circle font-size-16">
                                                    <i class="ri-shopping-cart-line"></i>
                                                </span>
                                            </div>
                                            <div class="flex-1">
                                                <h6 class="mb-1">Your order is placed</h6>
                                                <div class="font-size-12 text-muted">
                                                    <p class="mb-1">If several languages coalesce the grammar</p>
                                                    <p class="mb-0"><i class="mdi mdi-clock-outline"></i> 3 min ago</p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="" class="text-reset notification-item">
                                        <div class="d-flex">
                                            <img src="assets/images/users/avatar-3.jpg"
                                                class="me-3 rounded-circle avatar-xs" alt="user-pic">
                                            <div class="flex-1">
                                                <h6 class="mb-1">James Lemire</h6>
                                                <div class="font-size-12 text-muted">
                                                    <p class="mb-1">It will seem like simplified English.</p>
                                                    <p class="mb-0"><i class="mdi mdi-clock-outline"></i> 1 hours ago
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="" class="text-reset notification-item">
                                        <div class="d-flex">
                                            <div class="avatar-xs me-3">
                                                <span class="avatar-title bg-success rounded-circle font-size-16">
                                                    <i class="ri-checkbox-circle-line"></i>
                                                </span>
                                            </div>
                                            <div class="flex-1">
                                                <h6 class="mb-1">Your item is shipped</h6>
                                                <div class="font-size-12 text-muted">
                                                    <p class="mb-1">If several languages coalesce the grammar</p>
                                                    <p class="mb-0"><i class="mdi mdi-clock-outline"></i> 3 min ago</p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
    
                                    <a href="" class="text-reset notification-item">
                                        <div class="d-flex">
                                            <img src="assets/images/users/avatar-4.jpg"
                                                class="me-3 rounded-circle avatar-xs" alt="user-pic">
                                            <div class="flex-1">
                                                <h6 class="mb-1">Salena Layfield</h6>
                                                <div class="font-size-12 text-muted">
                                                    <p class="mb-1">As a skeptical Cambridge friend of mine occidental.
                                                    </p>
                                                    <p class="mb-0"><i class="mdi mdi-clock-outline"></i> 1 hours ago
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="p-2 border-top">
                                    <div class="d-grid">
                                        <a class="btn btn-sm btn-link font-size-14 text-center" href="javascript:void(0)">
                                            <i class="mdi mdi-arrow-right-circle me-1"></i> View More..
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
    
                        <div class="dropdown d-inline-block user-dropdown">
                            <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                @if (Auth::user()->img == null)
                                    <img src="{{ asset('assets/images/default-image.jpg') }}" height="32px" width="32px"
                                        alt="Header Avatar" class="rounded-circle header-profile-user">
                                @else
                                    <img src="{{ asset('storage/person/' . Auth::user()->img) }}" height="32px"
                                        width="32px" alt="Header Avatar" class="rounded-circle header-profile-user">
                                @endif
                                <span class="d-none d-xl-inline-block ms-1">
                                    {{ Auth::user()->fname }} {{ Auth::user()->lname }}
                                </span>
                                <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                              
                                <a class="dropdown-item" href="{{ url('user/profile_edit/' . Auth::user()->id) }}"><i
                                        class="ri-user-line align-middle me-1"></i> Profile</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                                    class="text-reset notification-item"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                                        class="ri-shut-down-line align-middle me-1 text-danger"></i> Logout</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </div>
    
                        <div class="dropdown d-inline-block user-dropdown">
                        </div>
            
                    </div>
                </div>
            </header>
    
            <div class="topnav bg-dark">
                <div class="container-fluid">
                    <nav class="navbar navbar-light navbar-expand-lg topnav-menu">

                        <div class="collapse navbar-collapse" id="topnav-menu-content">
                            <ul class="navbar-nav">

                                <li class="nav-item">
                                    <a class="nav-link" href="">
                                        <i class="ri-dashboard-line me-2"></i> Dashboard
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('repaire_calenda') }}">
                                        <i class="fa-solid fa-calendar-days text-warning me-2"></i> ปฎิทิน
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('repaire_req') }}">
                                        <i class="fa-solid fa-clipboard-list text-info me-2"></i> รายการแจ้งซ่อม
                                    </a>
                                </li>
                                {{-- <li class="nav-item">
                                    <a class="nav-link" href="{{ url('computer/com_index') }}">
                                        <i class="fa-solid fa-computer text-danger me-2"></i>ทะเบียนคอมพิวเตอร์
                                    </a>
                                </li> --}}
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('repaire_tech') }}">
                                        <i class="fa-solid fa-hammer text-primary me-2"></i> ช่างซ่อม
                                    </a>
                                </li>
 
 

                            </ul>
                        </div>
                    </nav>
                </div>
            </div>

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">
 
                    <div class="page-content">

                        @yield('content')
        
                    </div>
                  
                    
            </div>
        </div>
                <!-- End Page-content -->
{{--                
                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6">
                                @foreach ($datadetail as $item)
                                <script>document.write(new Date().getFullYear())</script> © {{$item->orginfo_name}}.
                       
                                @endforeach 
                                
                            </div>
                            <div class="col-sm-6">
                                <div class="text-sm-end d-none d-sm-block">
                                    Crafted with <i class="mdi mdi-heart text-danger"></i> by Dekbanbanproject
                                </div>
                            </div>
                        </div>
                    </div>
                </footer> --}}
                
            </div>
            <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->

        <!-- Right Sidebar -->
        {{-- <div class="right-bar">
            <div data-simplebar class="h-100">
                <div class="rightbar-title d-flex align-items-center px-3 py-4">
            
                    <h5 class="m-0 me-2">Settings</h5>

                    <a href="javascript:void(0);" class="right-bar-toggle ms-auto">
                        <i class="mdi mdi-close noti-icon"></i>
                    </a>
                </div>


            </div>  
        </div> --}}
        <!-- /Right-bar -->

        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>

        <!-- JAVASCRIPT -->
    <!-- JAVASCRIPT -->
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script> --}}
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script> --}}
    {{-- <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>  --}}
    <script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('pkclaim/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('pkclaim/libs/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('pkclaim/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('pkclaim/libs/node-waves/waves.min.js') }}"></script>

    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>  --}}
    {{-- <script src="{{ asset('pkclaim/libs/select2/js/select2.min.js') }}"></script> --}}
    <script src="{{ asset('pkclaim/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('pkclaim/libs/spectrum-colorpicker2/spectrum.min.js') }}"></script>
    <script src="{{ asset('pkclaim/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js') }}"></script>
    <script src="{{ asset('pkclaim/libs/admin-resources/bootstrap-filestyle/bootstrap-filestyle.min.js') }}"></script>
    <script src="{{ asset('pkclaim/libs/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>

    <!-- jquery.vectormap map -->
    <script src="{{ asset('pkclaim/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
    <script src="{{ asset('pkclaim/libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-us-merc-en.js') }}">
    </script>

    <!-- Required datatable js -->
    <script src="{{ asset('pkclaim/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('pkclaim/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>

      <!-- Buttons examples -->
      <script src="{{ asset('pkclaim/libs/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
      <script src="{{ asset('pkclaim/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') }}"></script>
      <script src="{{ asset('pkclaim/libs/jszip/jszip.min.js') }}"></script>
      <script src="{{ asset('pkclaim/libs/pdfmake/build/pdfmake.min.js') }}"></script>
      <script src="{{ asset('pkclaim/libs/pdfmake/build/vfs_fonts.js') }}"></script>
      <script src="{{ asset('pkclaim/libs/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
      <script src="{{ asset('pkclaim/libs/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
      <script src="{{ asset('pkclaim/libs/datatables.net-buttons/js/buttons.colVis.min.js') }}"></script>
  
      <script src="{{ asset('pkclaim/libs/datatables.net-keytable/js/dataTables.keyTable.min.js') }}"></script>
    <script src="{{ asset('pkclaim/libs/datatables.net-select/js/dataTables.select.min.js') }}"></script>

    <!-- Responsive examples -->
    <script src="{{ asset('pkclaim/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('pkclaim/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>

     <!-- Datatable init js -->
     {{-- <script src="{{ asset('pkclaim/js/pages/datatables.init.js') }}"></script> --}}
     <script src="{{ asset('pkclaim/libs/twitter-bootstrap-wizard/jquery.bootstrap.wizard.min.js') }}"></script> 
     <script src="{{ asset('pkclaim/libs/twitter-bootstrap-wizard/prettify.js') }}"></script>
 
 
     <script src="{{ asset('pkclaim/js/pages/form-wizard.init.js') }}"></script>
    {{-- <script src="{{ asset('pkclaim/js/pages/dashboard.init.js') }}"></script> --}}
    {{-- <script src="{{ asset('js/select2.min.js') }}"></script> --}}
    <script src="{{asset('asset/js/plugins/select2/js/select2.full.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('fullcalendar/lib/moment.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('fullcalendar/fullcalendar.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('fullcalendar/lang/th.js') }}"></script>

    {{-- <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('js/dataTables.bootstrap5.min.js') }}"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- App js -->
    <script src="{{ asset('pkclaim/js/app.js') }}"></script>

        @yield('footer')

        <script type="text/javascript">
            $(document).ready(function() {
                $('#example').DataTable();
                $('#example2').DataTable();
                $('#example3').DataTable();
                $('#example4').DataTable();
                $('#example5').DataTable();
                $('#example_user').DataTable();
    
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
    
            });
    
            $(document).ready(function() {
                $('#insert_depForm').on('submit', function(e) {
                    e.preventDefault();
                    var form = this;
                    // alert('OJJJJOL');
                    $.ajax({
                        url: $(form).attr('action'),
                        method: $(form).attr('method'),
                        data: new FormData(form),
                        processData: false,
                        dataType: 'json',
                        contentType: false,
                        beforeSend: function() {
                            $(form).find('span.error-text').text('');
                        },
                        success: function(data) {
                            if (data.status == 0) {
    
                            } else {
                                Swal.fire({
                                    title: 'บันทึกข้อมูลสำเร็จ',
                                    text: "You Insert data success",
                                    icon: 'success',
                                    showCancelButton: false,
                                    confirmButtonColor: '#06D177',
                                    confirmButtonText: 'เรียบร้อย'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location =
                                            "{{ url('setting/setting_index') }}";
                                    }
                                })
                            }
                        }
                    });
                });
    
                $('#update_depForm').on('submit', function(e) {
                    e.preventDefault();
    
                    var form = this;
                    $.ajax({
                        url: $(form).attr('action'),
                        method: $(form).attr('method'),
                        data: new FormData(form),
                        processData: false,
                        dataType: 'json',
                        contentType: false,
                        beforeSend: function() {
                            $(form).find('span.error-text').text('');
                        },
                        success: function(data) {
                            if (data.status == 0) {
    
                            } else {
                                Swal.fire({
                                    title: 'แก้ไขข้อมูลสำเร็จ',
                                    text: "You edit data success",
                                    icon: 'success',
                                    showCancelButton: false,
                                    confirmButtonColor: '#06D177',
                                    confirmButtonText: 'เรียบร้อย'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location =
                                            "{{ url('setting/setting_index') }}";
                                    }
                                })
                            }
                        }
                    });
                });
            });
    
            $(document).ready(function() {
                $('#insert_depsubForm').on('submit', function(e) {
                    e.preventDefault();
                    var form = this;
                    $.ajax({
                        url: $(form).attr('action'),
                        method: $(form).attr('method'),
                        data: new FormData(form),
                        processData: false,
                        dataType: 'json',
                        contentType: false,
                        beforeSend: function() {
                            $(form).find('span.error-text').text('');
                        },
                        success: function(data) {
                            if (data.status == 0) {
    
                            } else {
                                Swal.fire({
                                    title: 'บันทึกข้อมูลสำเร็จ',
                                    text: "You Insert data success",
                                    icon: 'success',
                                    showCancelButton: false,
                                    confirmButtonColor: '#06D177',
                                    confirmButtonText: 'เรียบร้อย'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location =
                                            "{{ url('setting/depsub_index') }}";
                                    }
                                })
                            }
                        }
                    });
                });
    
                $('#update_depsubForm').on('submit', function(e) {
                    e.preventDefault();
    
                    var form = this;
                    $.ajax({
                        url: $(form).attr('action'),
                        method: $(form).attr('method'),
                        data: new FormData(form),
                        processData: false,
                        dataType: 'json',
                        contentType: false,
                        beforeSend: function() {
                            $(form).find('span.error-text').text('');
                        },
                        success: function(data) {
                            if (data.status == 0) {
    
                            } else {
                                Swal.fire({
                                    title: 'แก้ไขข้อมูลสำเร็จ',
                                    text: "You edit data success",
                                    icon: 'success',
                                    showCancelButton: false,
                                    confirmButtonColor: '#06D177',
                                    confirmButtonText: 'เรียบร้อย'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location =
                                            "{{ url('setting/depsub_index') }}";
                                    }
                                })
                            }
                        }
                    });
                });
            });
    
            $(document).ready(function() {
                $('#insert_depsubsubForm').on('submit', function(e) {
                    e.preventDefault();
                    var form = this;
                    $.ajax({
                        url: $(form).attr('action'),
                        method: $(form).attr('method'),
                        data: new FormData(form),
                        processData: false,
                        dataType: 'json',
                        contentType: false,
                        beforeSend: function() {
                            $(form).find('span.error-text').text('');
                        },
                        success: function(data) {
                            if (data.status == 0) {
    
                            } else {
                                Swal.fire({
                                    title: 'บันทึกข้อมูลสำเร็จ',
                                    text: "You Insert data success",
                                    icon: 'success',
                                    showCancelButton: false,
                                    confirmButtonColor: '#06D177',
                                    confirmButtonText: 'เรียบร้อย'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location =
                                            "{{ url('setting/depsubsub_index') }}";
                                    }
                                })
                            }
                        }
                    });
                });
    
                $('#update_depsubsubForm').on('submit', function(e) {
                    e.preventDefault();
    
                    var form = this;
                    $.ajax({
                        url: $(form).attr('action'),
                        method: $(form).attr('method'),
                        data: new FormData(form),
                        processData: false,
                        dataType: 'json',
                        contentType: false,
                        beforeSend: function() {
                            $(form).find('span.error-text').text('');
                        },
                        success: function(data) {
                            if (data.status == 0) {
    
                            } else {
                                Swal.fire({
                                    title: 'แก้ไขข้อมูลสำเร็จ',
                                    text: "You edit data success",
                                    icon: 'success',
                                    showCancelButton: false,
                                    confirmButtonColor: '#06D177',
                                    confirmButtonText: 'เรียบร้อย'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location =
                                            "{{ url('setting/depsubsub_index') }}";
                                    }
                                })
                            }
                        }
                    });
                });
            });
    
            $(document).ready(function() {
                $('#insert_leaderForm').on('submit', function(e) {
                    e.preventDefault();
                    var form = this;
                    $.ajax({
                        url: $(form).attr('action'),
                        method: $(form).attr('method'),
                        data: new FormData(form),
                        processData: false,
                        dataType: 'json',
                        contentType: false,
                        beforeSend: function() {
                            $(form).find('span.error-text').text('');
                        },
                        success: function(data) {
                            if (data.status == 0) {
    
                            } else {
                                Swal.fire({
                                    title: 'บันทึกข้อมูลสำเร็จ',
                                    text: "You Insert data success",
                                    icon: 'success',
                                    showCancelButton: false,
                                    confirmButtonColor: '#06D177',
                                    confirmButtonText: 'เรียบร้อย'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location = "{{ url('setting/leader') }}";
                                    }
                                })
                            }
                        }
                    });
                });
    
                $('#insert_leader2Form').on('submit', function(e) {
                    e.preventDefault();
                    var form = this;
                    $.ajax({
                        url: $(form).attr('action'),
                        method: $(form).attr('method'),
                        data: new FormData(form),
                        processData: false,
                        dataType: 'json',
                        contentType: false,
                        beforeSend: function() {
                            $(form).find('span.error-text').text('');
                        },
                        success: function(data) {
                            if (data.status == 0) {
    
                            } else {
                                Swal.fire({
                                    title: 'บันทึกข้อมูลสำเร็จ',
                                    text: "You Insert data success",
                                    icon: 'success',
                                    showCancelButton: false,
                                    confirmButtonColor: '#06D177',
                                    confirmButtonText: 'เรียบร้อย'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location.reload();
    
                                    }
                                })
                            }
                        }
                    });
                });
    
                $('#insert_leadersubForm').on('submit', function(e) {
                    e.preventDefault();
                    var form = this;
                    $.ajax({
                        url: $(form).attr('action'),
                        method: $(form).attr('method'),
                        data: new FormData(form),
                        processData: false,
                        dataType: 'json',
                        contentType: false,
                        beforeSend: function() {
                            $(form).find('span.error-text').text('');
                        },
                        success: function(data) {
                            if (data.status == 0) {
    
                            } else {
                                Swal.fire({
                                    title: 'บันทึกข้อมูลสำเร็จ',
                                    text: "You Insert data success",
                                    icon: 'success',
                                    showCancelButton: false,
                                    confirmButtonColor: '#06D177',
                                    confirmButtonText: 'เรียบร้อย'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location.reload();
                                        // window.location="{{ url('setting/leader') }}";
                                    }
                                })
                            }
                        }
                    });
                });
    
            });
    
            $(document).ready(function() {
                $('#article_user_id').select2({
                    placeholder: "เลือกผู้รับผิดชอบ ",
                    allowClear: true
                });
                $('#article_status_id').select2({
                    placeholder: "เลือกสถานะ",
                    allowClear: true
                });
                $('#article_car_type_id').select2({
                    placeholder: "เพิ่มประเภท",
                    allowClear: true
                });
                $('#article_brand_id').select2({
                    placeholder: "เพิ่มยี่ห้อ",
                    allowClear: true
                });
                $('#article_color_id').select2({
                    placeholder: "เพิ่มสี",
                    allowClear: true
                });
                $('#article_deb_subsub_id').select2({
                    placeholder: "หน่วยงาน",
                    allowClear: true
                });
    
    
                $('#dep').select2({
                    placeholder: "กลุ่มงาน",
                    allowClear: true
                });
                $('#depsub').select2({
                    placeholder: "ฝ่าย/แผนก",
                    allowClear: true
                });
                $('#com_repaire_article_id').select2({
                    placeholder:"--เลือก--",
                    allowClear:true
                });
                $('#com_repaire_tec_id').select2({
                    placeholder:"--เลือก--",
                    allowClear:true
                });
                $('#com_repaire_tecrepaire_id').select2({
                    placeholder:"--เลือก--",
                    allowClear:true
                });
                $('#com_repaire_rep_id').select2({
                    placeholder:"--เลือก--",
                    allowClear:true
                });
                
                $('#team').select2({
                    placeholder: "ทีมนำองค์กร",
                    allowClear: true
                });
                $('#depsubsubtrue').select2({
                    placeholder: "หน่วยงานที่ปฎิบัติจริง",
                    allowClear: true
                });
                $('#book_objective').select2({
                    placeholder: "วัตถุประสงค์",
                    allowClear: true
                });
                $('#book_objective2').select2({
                    placeholder: "วัตถุประสงค์",
                    allowClear: true
                });
                $('#book_objective3').select2({
                    placeholder: "วัตถุประสงค์",
                    allowClear: true
                });
                $('#book_objective4').select2({
                    placeholder: "วัตถุประสงค์",
                    allowClear: true
                });
                $('#book_objective5').select2({
                    placeholder: "วัตถุประสงค์",
                    allowClear: true
                });
                $('#org_team_id').select2({
                    placeholder: "ทีมนำองค์กร",
                    allowClear: true
                });
            });
    
            $(document).on('click', '.edit_line', function() {
                var line_token_id = $(this).val();
                // alert(line_token_id);
                $('#linetokenModal').modal('show');
                $.ajax({
                    type: "GET",
                    url: "{{ url('setting/line_token_edit') }}" + '/' + line_token_id,
                    success: function(data) {
                        console.log(data.line_token.line_token_name);
                        $('#line_token_name').val(data.line_token.line_token_name)
                        $('#line_token_code').val(data.line_token.line_token_code)
                        $('#line_token_id').val(data.line_token.line_token_id)
                    },
                });
            });
    
            $(document).ready(function() {
                $('#insert_lineForm').on('submit', function(e) {
                    e.preventDefault();
    
                    var form = this;
                    //   alert('OJJJJOL');
                    $.ajax({
                        url: $(form).attr('action'),
                        method: $(form).attr('method'),
                        data: new FormData(form),
                        processData: false,
                        dataType: 'json',
                        contentType: false,
                        beforeSend: function() {
                            $(form).find('span.error-text').text('');
                        },
                        success: function(data) {
                            if (data.status == 0) {
    
                            } else {
                                Swal.fire({
                                    title: 'แก้ไขข้อมูลสำเร็จ',
                                    text: "You Update data success",
                                    icon: 'success',
                                    showCancelButton: false,
                                    confirmButtonColor: '#06D177',
                                    confirmButtonText: 'เรียบร้อย'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location.reload();
                                    }
                                })
                            }
                        }
                    });
                });
    
                $('#insert_permissForm').on('submit', function(e) {
                    e.preventDefault();
                    var form = this;
                    $.ajax({
                        url: $(form).attr('action'),
                        method: $(form).attr('method'),
                        data: new FormData(form),
                        processData: false,
                        dataType: 'json',
                        contentType: false,
                        beforeSend: function() {
                            $(form).find('span.error-text').text('');
                        },
                        success: function(data) {
                            if (data.status == 0) {
    
                            } else {
                                Swal.fire({
                                    title: 'บันทึกข้อมูลสำเร็จ',
                                    text: "You Insert data success",
                                    icon: 'success',
                                    showCancelButton: false,
                                    confirmButtonColor: '#06D177',
                                    confirmButtonText: 'เรียบร้อย'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location = "{{ url('setting/permiss') }}";
                                    }
                                })
                            }
                        }
                    });
                });
                $('#update_infoorgForm').on('submit', function(e) {
                    e.preventDefault();
                    var form = this;
                    $.ajax({
                        url: $(form).attr('action'),
                        method: $(form).attr('method'),
                        data: new FormData(form),
                        processData: false,
                        dataType: 'json',
                        contentType: false,
                        beforeSend: function() {
                            $(form).find('span.error-text').text('');
                        },
                        success: function(data) {
                            if (data.status == 0) {
    
                            } else {
                                Swal.fire({
                                    title: 'บันทึกข้อมูลสำเร็จ',
                                    text: "You Insert data success",
                                    icon: 'success',
                                    showCancelButton: false,
                                    confirmButtonColor: '#06D177',
                                    confirmButtonText: 'เรียบร้อย'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location.reload();
                                    }
                                })
                            }
                        }
                    });
                });
            });
        </script>
    </body>
</html>
