<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <meta name="viewport"
        content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no">
    <meta name="description"
        content="This dashboard was created as an example of the flexibility that Architect offers.">
    <!-- Disable tap highlight on IE -->
    <meta name="msapplication-tap-highlight" content="no">
      <!-- App favicon -->
      <link rel="shortcut icon" href="{{ asset('pkclaim/images/logo150.ico') }}">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
      <link href="{{ asset('pkclaim/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet">
      <link href="{{ asset('pkclaim/libs/spectrum-colorpicker2/spectrum.min.css') }}" rel="stylesheet" type="text/css">
      <link href="{{ asset('pkclaim/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css') }}" rel="stylesheet">

      
    <link rel="stylesheet" href="{{ asset('disacc/vendors/@fortawesome/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('disacc/vendors/ionicons-npm/css/ionicons.css') }}">
    <link rel="stylesheet" href="{{ asset('disacc/vendors/linearicons-master/dist/web-font/style.css') }}">
    <link rel="stylesheet"
        href="{{ asset('disacc/vendors/pixeden-stroke-7-icon-master/pe-icon-7-stroke/dist/pe-icon-7-stroke.css') }}">
    <link href="{{ asset('disacc/styles/css/base.css') }}" rel="stylesheet">
</head>

<body>
    <?php
    $datadetail = DB::connection('mysql')->select('   
                    select * from orginfo 
                    where orginfo_id = 1 
                ');
    ?>
    <div class="app-container app-theme-white body-tabs-shadow fixed-header fixed-sidebar">
        <div class="app-header header-shadow">
            <div class="app-header__logo">
                {{-- <div class="logo-src"></div> --}}
                <div class="header__pane ms-auto">
                    <div>
                        <button type="button" class="hamburger close-sidebar-btn hamburger--elastic"
                            data-class="closed-sidebar">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="app-header__mobile-menu">
                <div>
                    <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                        <span class="hamburger-box">
                            <span class="hamburger-inner"></span>
                        </span>
                    </button>
                </div>
            </div>
            <div class="app-header__menu">
                <span>
                    <button type="button"
                        class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                        <span class="btn-icon-wrapper">
                            <i class="fa fa-ellipsis-v fa-w-6"></i>
                        </span>
                    </button>
                </span>
            </div>
            <div class="app-header__content">
                <div class="app-header-left">
                    @foreach ($datadetail as $item)
                        <label for=""
                            style="font-size: 22px;color:rgb(150, 22, 167)">{{ $item->orginfo_name }}</label>
                    @endforeach

                    <ul class="header-megamenu nav">

                    </ul>
                </div>
                <div class="app-header-right">
                    <div class="header-dots">
                        <div class="dropdown">
                            <button type="button" aria-haspopup="true" aria-expanded="false" data-bs-toggle="dropdown"
                                class="p-0 me-2 btn btn-link">
                                <span class="icon-wrapper icon-wrapper-alt rounded-circle">
                                    <span class="icon-wrapper-bg bg-danger"></span>
                                    <i class="icon text-danger icon-anim-pulse ion-android-notifications"></i>
                                    <span class="badge badge-dot badge-dot-sm bg-danger">Notifications</span>
                                </span>
                            </button>
                            <div tabindex="-1" role="menu" aria-hidden="true"
                                class="dropdown-menu-xl rm-pointers dropdown-menu dropdown-menu-right">
                                <div class="dropdown-menu-header mb-0">
                                    <div class="dropdown-menu-header-inner bg-deep-blue">
                                        <div class="menu-header-image opacity-1"
                                            style="background-image: url('images/dropdown-header/city3.jpg');"></div>
                                        <div class="menu-header-content text-dark">
                                            <h5 class="menu-header-title">Notifications</h5>
                                            <h6 class="menu-header-subtitle">You have
                                                <b>21</b> unread messages
                                            </h6>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab-messages-header" role="tabpanel">
                                        <div class="scroll-area-sm">
                                            <div class="scrollbar-container">
                                                <div class="p-3">
                                                    <div class="notifications-box">
                                                        <div
                                                            class="vertical-time-simple vertical-without-time vertical-timeline vertical-timeline--one-column">
                                                            <div
                                                                class="vertical-timeline-item dot-danger vertical-timeline-element">
                                                                <div>
                                                                    <span
                                                                        class="vertical-timeline-element-icon bounce-in"></span>
                                                                    <div
                                                                        class="vertical-timeline-element-content bounce-in">
                                                                        <h4 class="timeline-title">All Hands Meeting
                                                                        </h4>
                                                                        <span
                                                                            class="vertical-timeline-element-date"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div
                                                                class="vertical-timeline-item dot-warning vertical-timeline-element">
                                                                <div>
                                                                    <span
                                                                        class="vertical-timeline-element-icon bounce-in"></span>
                                                                    <div
                                                                        class="vertical-timeline-element-content bounce-in">
                                                                        <p>Yet another one, at
                                                                            <span class="text-success">15:00 PM</span>
                                                                        </p>
                                                                        <span
                                                                            class="vertical-timeline-element-date"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div
                                                                class="vertical-timeline-item dot-success vertical-timeline-element">
                                                                <div>
                                                                    <span
                                                                        class="vertical-timeline-element-icon bounce-in"></span>
                                                                    <div
                                                                        class="vertical-timeline-element-content bounce-in">
                                                                        <h4 class="timeline-title">
                                                                            Build the production release
                                                                            <span
                                                                                class="badge bg-danger ms-2">NEW</span>
                                                                        </h4>
                                                                        <span
                                                                            class="vertical-timeline-element-date"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div
                                                                class="vertical-timeline-item dot-primary vertical-timeline-element">
                                                                <div>
                                                                    <span
                                                                        class="vertical-timeline-element-icon bounce-in"></span>
                                                                    <div
                                                                        class="vertical-timeline-element-content bounce-in">
                                                                        <h4 class="timeline-title">
                                                                            Something not important
                                                                            <div
                                                                                class="avatar-wrapper mt-2 avatar-wrapper-overlap">
                                                                                <div
                                                                                    class="avatar-icon-wrapper avatar-icon-sm">
                                                                                    <div class="avatar-icon">
                                                                                        <img src="images/avatars/1.jpg"
                                                                                            alt="">
                                                                                    </div>
                                                                                </div>
                                                                                <div
                                                                                    class="avatar-icon-wrapper avatar-icon-sm">
                                                                                    <div class="avatar-icon">
                                                                                        <img src="images/avatars/2.jpg"
                                                                                            alt="">
                                                                                    </div>
                                                                                </div>
                                                                                <div
                                                                                    class="avatar-icon-wrapper avatar-icon-sm">
                                                                                    <div class="avatar-icon">
                                                                                        <img src="images/avatars/3.jpg"
                                                                                            alt="">
                                                                                    </div>
                                                                                </div>
                                                                                <div
                                                                                    class="avatar-icon-wrapper avatar-icon-sm">
                                                                                    <div class="avatar-icon">
                                                                                        <img src="images/avatars/4.jpg"
                                                                                            alt="">
                                                                                    </div>
                                                                                </div>
                                                                                <div
                                                                                    class="avatar-icon-wrapper avatar-icon-sm">
                                                                                    <div class="avatar-icon">
                                                                                        <img src="images/avatars/5.jpg"
                                                                                            alt="">
                                                                                    </div>
                                                                                </div>
                                                                                <div
                                                                                    class="avatar-icon-wrapper avatar-icon-sm">
                                                                                    <div class="avatar-icon">
                                                                                        <img src="images/avatars/9.jpg"
                                                                                            alt="">
                                                                                    </div>
                                                                                </div>
                                                                                <div
                                                                                    class="avatar-icon-wrapper avatar-icon-sm">
                                                                                    <div class="avatar-icon">
                                                                                        <img src="images/avatars/7.jpg"
                                                                                            alt="">
                                                                                    </div>
                                                                                </div>
                                                                                <div
                                                                                    class="avatar-icon-wrapper avatar-icon-sm">
                                                                                    <div class="avatar-icon">
                                                                                        <img src="images/avatars/8.jpg"
                                                                                            alt="">
                                                                                    </div>
                                                                                </div>
                                                                                <div
                                                                                    class="avatar-icon-wrapper avatar-icon-sm avatar-icon-add">
                                                                                    <div class="avatar-icon">
                                                                                        <i>+</i>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </h4>
                                                                        <span
                                                                            class="vertical-timeline-element-date"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div
                                                                class="vertical-timeline-item dot-info vertical-timeline-element">
                                                                <div>
                                                                    <span
                                                                        class="vertical-timeline-element-icon bounce-in"></span>
                                                                    <div
                                                                        class="vertical-timeline-element-content bounce-in">
                                                                        <h4 class="timeline-title">This dot has an info
                                                                            state</h4>
                                                                        <span
                                                                            class="vertical-timeline-element-date"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div
                                                                class="vertical-timeline-item dot-danger vertical-timeline-element">
                                                                <div>
                                                                    <span
                                                                        class="vertical-timeline-element-icon bounce-in"></span>
                                                                    <div
                                                                        class="vertical-timeline-element-content bounce-in">
                                                                        <h4 class="timeline-title">All Hands Meeting
                                                                        </h4>
                                                                        <span
                                                                            class="vertical-timeline-element-date"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div
                                                                class="vertical-timeline-item dot-warning vertical-timeline-element">
                                                                <div>
                                                                    <span
                                                                        class="vertical-timeline-element-icon bounce-in"></span>
                                                                    <div
                                                                        class="vertical-timeline-element-content bounce-in">
                                                                        <p>Yet another one, at
                                                                            <span class="text-success">15:00 PM</span>
                                                                        </p>
                                                                        <span
                                                                            class="vertical-timeline-element-date"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div
                                                                class="vertical-timeline-item dot-success vertical-timeline-element">
                                                                <div>
                                                                    <span
                                                                        class="vertical-timeline-element-icon bounce-in"></span>
                                                                    <div
                                                                        class="vertical-timeline-element-content bounce-in">
                                                                        <h4 class="timeline-title">
                                                                            Build the production release
                                                                            <span
                                                                                class="badge bg-danger ms-2">NEW</span>
                                                                        </h4>
                                                                        <span
                                                                            class="vertical-timeline-element-date"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div
                                                                class="vertical-timeline-item dot-dark vertical-timeline-element">
                                                                <div>
                                                                    <span
                                                                        class="vertical-timeline-element-icon bounce-in"></span>
                                                                    <div
                                                                        class="vertical-timeline-element-content bounce-in">
                                                                        <h4 class="timeline-title">This dot has a dark
                                                                            state</h4>
                                                                        <span
                                                                            class="vertical-timeline-element-date"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <ul class="nav flex-column">
                                    <li class="nav-item-divider nav-item"></li>
                                    <li class="nav-item-btn text-center nav-item">
                                        <button class="btn-shadow btn-wide btn-pill btn btn-focus btn-sm">View Latest
                                            Changes</button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="app-main">
            <div class="app-sidebar sidebar-shadow">
                <div class="app-header__logo">
                    <div class="logo-src"></div>
                    <div class="header__pane ms-auto">
                        <div>
                            <button type="button" class="hamburger close-sidebar-btn hamburger--elastic"
                                data-class="closed-sidebar">
                                <span class="hamburger-box">
                                    <span class="hamburger-inner"></span>
                                </span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="app-header__mobile-menu">
                    <div>
                        <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
                <div class="app-header__menu">
                    <span>
                        <button type="button"
                            class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                            <span class="btn-icon-wrapper">
                                <i class="fa fa-ellipsis-v fa-w-6"></i>
                            </span>
                        </button>
                    </span>
                </div>
                <div class="scrollbar-sidebar">
                    <div class="app-sidebar__inner">
                        <ul class="vertical-nav-menu">
                            <li class="app-sidebar__heading">Menu</li>
                            <li class="mm-active">
                                <a href="#">
                                    <i class="metismenu-icon pe-7s-rocket"></i>
                                    Authen Code
                                    <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                                </a>
                                <ul class="mm-show">
                                    <li>
                                        <a href="{{ url('authen_dashboard') }}">
                                            <i class="metismenu-icon"></i>
                                            Dashboard
                                        </a>
                                    </li>
                                    {{-- <li>
                                        <a href="{{ url('authen/checkauthen_main') }}">
                                            <i class="metismenu-icon"></i>
                                            Authen Main
                                        </a>
                                    </li> --}}
                                    {{-- <li>
                                        <a href="{{ url('authen/checkauthen_auto') }}" target="_blank">
                                            <i class="metismenu-icon"></i>
                                            Authen Auto
                                        </a>
                                    </li> --}}
                                    {{-- <li>
                                        <a href="{{ url('authen/checkauthen_autospsch') }}" target="_blank">
                                            <i class="metismenu-icon"></i>
                                            Authen Report สปสช
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ url('authen/checkauthen_update_vn') }}" target="_blank">
                                            <i class="metismenu-icon"></i>
                                            Update VN Authen Report
                                        </a>
                                    </li> --}}
                                </ul>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
            <div class="app-main__outer">
                <div class="app-main__inner">

                    @yield('content')

                </div>
                <div class="app-wrapper-footer">
                    <div class="app-footer">
                        <div class="app-footer__inner">
                            <div class="app-footer-left">
                                <div class="footer-dots">

                                    <div class="dropdown">
                                        <a class="dot-btn-wrapper dd-chart-btn-2" aria-haspopup="true"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="dot-btn-icon lnr-pie-chart icon-gradient bg-love-kiss"></i>
                                            <div class="badge badge-dot badge-abs badge-dot-sm bg-warning">
                                                Notifications</div>
                                        </a>
                                        <div tabindex="-1" role="menu" aria-hidden="true"
                                            class="dropdown-menu-xl rm-pointers dropdown-menu">
                                            <div class="dropdown-menu-header">
                                                <div class="dropdown-menu-header-inner bg-premium-dark">
                                                    <div class="menu-header-image"
                                                        style="background-image: url('images/dropdown-header/abstract4.jpg');">
                                                    </div>
                                                    <div class="menu-header-content text-white">
                                                        <h5 class="menu-header-title">Users Online</h5>
                                                        <h6 class="menu-header-subtitle">Account Activity
                                                            Overview</h6>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="widget-chart">
                                                <div class="widget-chart-content">
                                                    <div class="icon-wrapper rounded-circle">
                                                        <div class="icon-wrapper-bg opacity-9 bg-focus"></div>
                                                        <i class="lnr-users text-white"></i>
                                                    </div>
                                                    <div class="widget-numbers">
                                                        <span>3 (คน)</span>
                                                    </div>
                                                    <div class="widget-subheading pt-2"> Profile views
                                                    </div>
                                                    <div class="widget-description text-danger">
                                                        <span class="pe-1">
                                                            <span>176%</span>
                                                        </span>
                                                        <i class="fa fa-arrow-left"></i>
                                                    </div>
                                                </div>
                                                <div class="widget-chart-wrapper">
                                                    <div id="dashboard-sparkline-carousel-4-pop"></div>
                                                </div>
                                            </div>
                                            <ul class="nav flex-column">
                                                <li class="nav-item-divider mt-0 nav-item"></li>
                                                <li class="nav-item-btn text-center nav-item">
                                                    <button class="btn-shine btn-wide btn-pill btn btn-warning btn-sm">
                                                        <i class="fa fa-cog fa-spin me-2"></i>
                                                        View Details
                                                    </button>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="app-footer-right">
                                <ul class="header-megamenu nav">
                                    <li class="nav-item">
                                        <a data-bs-placement="top" rel="popover-focus" data-offset="300"
                                            data-toggle="popover-custom" class="nav-link">
                                            Create By Pradit Raha - งานประกัน
                                            <i class="fa fa-angle-up ms-2 opacity-8"></i>
                                        </a>
                                        {{-- <div class="rm-max-width rm-pointers">
                                            <div class="d-none popover-custom-content">
                                                <div class="dropdown-mega-menu dropdown-mega-menu-sm">
                                                    <div class="grid-menu grid-menu-2col">
                                                        <div class="g-0 row">
                                                            <div class="col-sm-6 col-xl-6">
                                                                <ul class="nav flex-column">
                                                                    <li class="nav-item-header nav-item">Overview</li>
                                                                    <li class="nav-item">
                                                                        <a class="nav-link">
                                                                            <i class="nav-link-icon lnr-inbox"></i>
                                                                            <span>Contacts</span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="nav-item">
                                                                        <a class="nav-link">
                                                                            <i class="nav-link-icon lnr-book"></i>
                                                                            <span>Incidents</span>
                                                                            <div
                                                                                class="ms-auto badge rounded-pill bg-danger">
                                                                                5</div>
                                                                        </a>
                                                                    </li>
                                                                    <li class="nav-item">
                                                                        <a class="nav-link">
                                                                            <i class="nav-link-icon lnr-picture"></i>
                                                                            <span>Companies</span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="nav-item">
                                                                        <a disabled="" class="nav-link disabled">
                                                                            <i
                                                                                class="nav-link-icon lnr-file-empty"></i>
                                                                            <span>Dashboards</span>
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <div class="col-sm-6 col-xl-6">
                                                                <ul class="nav flex-column">
                                                                    <li class="nav-item-header nav-item">Sales &amp;
                                                                        Marketing</li>
                                                                    <li class="nav-item">
                                                                        <a class="nav-link">Queues</a>
                                                                    </li>
                                                                    <li class="nav-item">
                                                                        <a class="nav-link">Resource Groups</a>
                                                                    </li>
                                                                    <li class="nav-item">
                                                                        <a class="nav-link">
                                                                            Goal Metrics
                                                                            <div class="ms-auto badge bg-warning">3
                                                                            </div>
                                                                        </a>
                                                                    </li>
                                                                    <li class="nav-item">
                                                                        <a class="nav-link">Campaigns</a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> --}}
                                    </li>
                                    {{-- <li class="nav-item">
                                            <a data-bs-placement="top" rel="popover-focus" data-offset="300"
                                                data-toggle="popover-custom" class="nav-link">
                                                Grid Menu
                                                <div class="badge bg-dark ms-0 ms-1">
                                                    <small>NEW</small>
                                                </div>
                                                <i class="fa fa-angle-up ms-2 opacity-8"></i>
                                            </a>
                                            <div class="rm-max-width rm-pointers">
                                                <div class="d-none popover-custom-content">
                                                    <div class="dropdown-menu-header">
                                                        <div class="dropdown-menu-header-inner bg-tempting-azure">
                                                            <div class="menu-header-image opacity-1" style="background-image: url('images/dropdown-header/city5.jpg');"></div>
                                                            <div class="menu-header-content text-dark">
                                                                <h5 class="menu-header-title">Two Column Grid</h5>
                                                                <h6 class="menu-header-subtitle">Easy grid navigation inside popovers</h6>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="grid-menu grid-menu-2col">
                                                        <div class="g-0 row">
                                                            <div class="col-sm-6">
                                                                <button class="btn-icon-vertical btn-transition-text btn-transition btn-transition-alt pt-2 pb-2 btn btn-outline-dark">
                                                                    <i class="lnr-lighter text-dark opacity-7 btn-icon-wrapper mb-2"></i>
                                                                    Automation
                                                                </button>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <button class="btn-icon-vertical btn-transition-text btn-transition btn-transition-alt pt-2 pb-2 btn btn-outline-danger">
                                                                    <i class="lnr-construction text-danger opacity-7 btn-icon-wrapper mb-2"></i>
                                                                    Reports
                                                                </button>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <button class="btn-icon-vertical btn-transition-text btn-transition btn-transition-alt pt-2 pb-2 btn btn-outline-success">
                                                                    <i class="lnr-bus text-success opacity-7 btn-icon-wrapper mb-2"></i>
                                                                    Activity
                                                                </button>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <button class="btn-icon-vertical btn-transition-text btn-transition btn-transition-alt pt-2 pb-2 btn btn-outline-focus">
                                                                    <i class="lnr-gift text-focus opacity-7 btn-icon-wrapper mb-2"></i>
                                                                    Settings
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <ul class="nav flex-column">
                                                        <li class="nav-item-divider nav-item"></li>
                                                        <li class="nav-item-btn clearfix nav-item">
                                                            <div class="float-start">
                                                                <button class="btn btn-link btn-sm">Link Button</button>
                                                            </div>
                                                            <div class="float-end">
                                                                <button class="btn-shadow btn btn-info btn-sm">Info Button</button>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </li> --}}
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="app-drawer-overlay d-none animated fadeIn"></div>
    <!-- plugin dependencies -->
    <script type="text/javascript" src="{{ asset('disacc/vendors/jquery/dist/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('disacc/vendors/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('disacc/vendors/moment/moment.js') }}"></script>
    <script type="text/javascript" src="{{ asset('disacc/vendors/metismenu/dist/metisMenu.js') }}"></script>
    <script type="text/javascript" src="{{ asset('disacc/vendors/bootstrap4-toggle/js/bootstrap4-toggle.min.js') }}">
    </script>
    <script type="text/javascript" src="{{ asset('disacc/vendors/jquery-circle-progress/dist/circle-progress.min.js') }}">
    </script>
    <script type="text/javascript" src="{{ asset('disacc/vendors/perfect-scrollbar/dist/perfect-scrollbar.min.js') }}">
    </script>
    <script type="text/javascript" src="{{ asset('disacc/vendors/toastr/build/toastr.min.js') }}"></script>
    <script type="text/javascript"
        src="{{ asset('disacc/vendors/jquery.fancytree/dist/jquery.fancytree-all-deps.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('disacc/vendors/apexcharts/dist/apexcharts.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('disacc/vendors/chart.js/dist/Chart.min.js') }}"></script>

    <!-- datatables.js -->
    <script type="text/javascript" src="{{ asset('disacc/vendors/bootstrap-table/dist/bootstrap-table.min.js') }}">
    </script>
    <script type="text/javascript" src="{{ asset('disacc/vendors/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('disacc/vendors/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}">
    </script>
    <script type="text/javascript"
        src="{{ asset('disacc/vendors/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script type="text/javascript"
        src="{{ asset('disacc/vendors/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>
    <!-- Loadding.js -->
    <script type="text/javascript" src="{{ asset('disacc/vendors/block-ui/jquery.blockUI.js') }}"></script>
    <script type="text/javascript" src="{{ asset('disacc/js/blockui.js') }}"></script>
    <!-- custome.js -->
    <script type="text/javascript" src="{{ asset('disacc/js/charts/apex-charts.js') }}"></script>
    <script type="text/javascript" src="{{ asset('disacc/js/circle-progress.js') }}"></script>
    <script type="text/javascript" src="{{ asset('disacc/js/demo.js') }}"></script>
    <script type="text/javascript" src="{{ asset('disacc/js/scrollbar.js') }}"></script>
    <script type="text/javascript" src="{{ asset('disacc/js/toastr.js') }}"></script>
    <script type="text/javascript" src="{{ asset('disacc/js/treeview.js') }}"></script>
    <script type="text/javascript" src="{{ asset('disacc/js/form-components/toggle-switch.js') }}"></script>
    <script type="text/javascript" src="{{ asset('disacc/js/charts/chartjs.js') }}"></script>
    {{-- <script type="text/javascript" src="{{ asset('disacc/js/app.js') }}"></script> --}}

    <script src="{{ asset('js/select2.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="{{ asset('pkclaim/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('pkclaim/libs/spectrum-colorpicker2/spectrum.min.js') }}"></script>
    <script src="{{ asset('pkclaim/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js') }}"></script>
    <script src="{{ asset('pkclaim/libs/admin-resources/bootstrap-filestyle/bootstrap-filestyle.min.js') }}"></script>
    <script src="{{ asset('pkclaim/libs/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>

    <script src="{{ asset('pkclaim/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/locales/bootstrap-datepicker.th.min.js" integrity="sha512-cp+S0Bkyv7xKBSbmjJR0K7va0cor7vHYhETzm2Jy//ZTQDUvugH/byC4eWuTii9o5HN9msulx2zqhEXWau20Dg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


    @yield('footer')


   <!-- Large modal รายละเอียด(คน)-->
 <div class="modal fade" id="authen_detailModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg w-auto">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLongTitle" style="color: red:" >รายละเอียด
                </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <div id="detail"></div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button> 
            </div>
        </div>
    </div>
</div>


    <script type="text/javascript">
        $(document).ready(function() {
            $('#example').DataTable();

           
        });
       
    </script>
</body>

</html>
