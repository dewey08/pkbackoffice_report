<!doctype html>
<html lang="en">
    <head> 
       <meta charset="utf-8">
       
       <meta name="csrf-token" content="{{ csrf_token() }}">
       <title>@yield('title')</title>
          <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('apkclaim/images/logo150.ico') }}">
 
          <!-- Font Awesome -->
    <link href="{{ asset('assets/fontawesome/css/all.css') }}" rel="stylesheet">
        <link href="{{ asset('acccph/vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet"> 
        <link rel="stylesheet" href="{{ asset('acccph/vendors/@fortawesome/fontawesome-free/css/all.min.css') }}">
        <link rel="stylesheet" href="{{ asset('acccph/vendors/ionicons-npm/css/ionicons.css') }}">
        <link rel="stylesheet" href="{{ asset('acccph/vendors/linearicons-master/dist/web-font/style.css') }}">
        <link rel="stylesheet" href="{{ asset('acccph/vendors/pixeden-stroke-7-icon-master/pe-icon-7-stroke/dist/pe-icon-7-stroke.css') }}">
        {{-- <link href="{{asset('acccph/styles/css/base.css" rel="stylesheet') }}"> --}}

        <link rel="stylesheet" href="../acccph/styles/css/base.css" >
    </head>
    <body>
        <div class="app-container app-theme-white body-tabs-shadow fixed-header fixed-sidebar">
            <div class="app-header header-shadow">
                <div class="app-header__logo">
                    {{-- <div class="logo-src"></div> --}}
                    <div> 
                        <img src="{{ asset('apkclaim/images/logo150.png') }}" alt="logo-sm-light" height="40"> 
                    </div>
                    <div class="mt-3">
                        <h3 style="color:blueviolet" class="ms-3">PK</h3>
                    </div>
                    <div class="header__pane ms-auto">
                        <div>
                            <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
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
                        <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                            <span class="btn-icon-wrapper">
                                <i class="fa fa-ellipsis-v fa-w-6"></i>
                            </span>
                        </button>
                    </span>
                </div>
                <div class="app-header__content">
                    <div class="app-header-left">
                        {{-- <div class="search-wrapper">
                            <div class="input-holder">
                                <input type="text" class="search-input" placeholder="Type to search">
                                <button class="search-icon">
                                    <span></span>
                                </button>
                            </div>
                            <button class="btn-close"></button>
                        </div> --}}
                        <ul class="header-megamenu nav">
                            {{-- <li class="nav-item">
                                <a href="javascript:void(0);" data-bs-placement="bottom" rel="popover-focus"
                                    data-offset="300" data-toggle="popover-custom" class="nav-link">
                                    <i class="nav-link-icon pe-7s-gift me-4"></i>
                                    Mega Menu
                                    <i class="fa fa-angle-down ms-2 opacity-5"></i>
                                </a>
                                <div class="rm-max-width">
                                    <div class="d-none popover-custom-content">
                                        <div class="dropdown-mega-menu">
                                            <div class="grid-menu grid-menu-3col">
                                                <div class="g-0 row">
                                                    <div class="col-sm-6 col-xl-4">
                                                        <ul class="nav flex-column">
                                                            <li class="nav-item-header nav-item"> Overview</li>
                                                            <li class="nav-item">
                                                                <a href="javascript:void(0);" class="nav-link">
                                                                    <i class="nav-link-icon lnr-inbox"></i>
                                                                    <span> Contacts</span>
                                                                </a>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a href="javascript:void(0);" class="nav-link">
                                                                    <i class="nav-link-icon lnr-book"></i>
                                                                    <span> Incidents</span>
                                                                    <div class="ms-auto badge rounded-pill bg-danger">5</div>
                                                                </a>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a href="javascript:void(0);" class="nav-link">
                                                                    <i class="nav-link-icon lnr-picture"></i>
                                                                    <span> Companies</span>
                                                                </a>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a disabled="" href="javascript:void(0);" class="nav-link disabled">
                                                                    <i class="nav-link-icon lnr-file-empty"></i>
                                                                    <span> Dashboards</span>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-sm-6 col-xl-4">
                                                        <ul class="nav flex-column">
                                                            <li class="nav-item-header nav-item"> Favourites</li>
                                                            <li class="nav-item">
                                                                <a href="javascript:void(0);" class="nav-link"> Reports Conversions</a>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a href="javascript:void(0);" class="nav-link">
                                                                    Quick Start
                                                                    <div class="ms-auto badge bg-success">New</div>
                                                                </a>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a href="javascript:void(0);" class="nav-link">Users &amp; Groups</a>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a href="javascript:void(0);" class="nav-link">Proprieties</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-sm-6 col-xl-4">
                                                        <ul class="nav flex-column">
                                                            <li class="nav-item-header nav-item">Sales &amp; Marketing</li>
                                                            <li class="nav-item">
                                                                <a href="javascript:void(0);" class="nav-link">Queues</a>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a href="javascript:void(0);" class="nav-link">Resource Groups</a>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a href="javascript:void(0);" class="nav-link">
                                                                    Goal Metrics
                                                                    <div class="ms-auto badge bg-warning">3</div>
                                                                </a>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a href="javascript:void(0);" class="nav-link">Campaigns</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li> --}}
                            
                        </ul>
                    </div>
                    <div class="app-header-right">
                        <div class="header-dots">
                            {{-- <div class="dropdown">
                                <button type="button" aria-haspopup="true" aria-expanded="false"
                                    data-bs-toggle="dropdown" class="p-0 me-2 btn btn-link">
                                    <span class="icon-wrapper icon-wrapper-alt rounded-circle">
                                        <span class="icon-wrapper-bg bg-primary"></span>
                                        <i class="icon text-primary ion-android-apps"></i>
                                    </span>
                                </button>
                                <div tabindex="-1" role="menu" aria-hidden="true"
                                    class="dropdown-menu-xl rm-pointers dropdown-menu dropdown-menu-right">
                                    <div class="dropdown-menu-header">
                                        <div class="dropdown-menu-header-inner bg-plum-plate">
                                            <div class="menu-header-image" style="background-image: url('images/dropdown-header/abstract4.jpg');"></div>
                                            <div class="menu-header-content text-white">
                                                <h5 class="menu-header-title">Grid Dashboard</h5>
                                                <h6 class="menu-header-subtitle">Easy grid navigation inside dropdowns</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="grid-menu grid-menu-xl grid-menu-3col">
                                        <div class="g-0 row">
                                            <div class="col-sm-6 col-xl-4">
                                                <button class="btn-icon-vertical btn-square btn-transition btn btn-outline-link">
                                                    <i class="pe-7s-world icon-gradient bg-night-fade btn-icon-wrapper btn-icon-lg mb-3"></i>
                                                    Automation
                                                </button>
                                            </div>
                                            <div class="col-sm-6 col-xl-4">
                                                <button class="btn-icon-vertical btn-square btn-transition btn btn-outline-link">
                                                    <i class="pe-7s-piggy icon-gradient bg-night-fade btn-icon-wrapper btn-icon-lg mb-3"></i>
                                                    Reports
                                                </button>
                                            </div>
                                            <div class="col-sm-6 col-xl-4">
                                                <button class="btn-icon-vertical btn-square btn-transition btn btn-outline-link">
                                                    <i class="pe-7s-config icon-gradient bg-night-fade btn-icon-wrapper btn-icon-lg mb-3"></i>
                                                    Settings
                                                </button>
                                            </div>
                                            <div class="col-sm-6 col-xl-4">
                                                <button class="btn-icon-vertical btn-square btn-transition btn btn-outline-link">
                                                    <i class="pe-7s-browser icon-gradient bg-night-fade btn-icon-wrapper btn-icon-lg mb-3"></i>
                                                    Content
                                                </button>
                                            </div>
                                            <div class="col-sm-6 col-xl-4">
                                                <button class="btn-icon-vertical btn-square btn-transition btn btn-outline-link">
                                                    <i class="pe-7s-hourglass icon-gradient bg-night-fade btn-icon-wrapper btn-icon-lg mb-3"></i>
                                                    Activity
                                                </button>
                                            </div>
                                            <div class="col-sm-6 col-xl-4">
                                                <button class="btn-icon-vertical btn-square btn-transition btn btn-outline-link">
                                                    <i class="pe-7s-world icon-gradient bg-night-fade btn-icon-wrapper btn-icon-lg mb-3"></i>
                                                    Contacts
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <ul class="nav flex-column">
                                        <li class="nav-item-divider nav-item"></li>
                                        <li class="nav-item-btn text-center nav-item">
                                            <button class="btn-shadow btn btn-primary btn-sm">Follow-ups</button>
                                        </li>
                                    </ul>
                                </div>
                            </div> --}}
                            <div class="dropdown">
                                <button type="button" aria-haspopup="true" aria-expanded="false"
                                    data-bs-toggle="dropdown" class="p-0 me-2 btn btn-link">
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
                                            <div class="menu-header-image opacity-1" style="background-image: url('images/dropdown-header/city3.jpg');"></div>
                                            <div class="menu-header-content text-dark">
                                                <h5 class="menu-header-title">Notifications</h5>
                                                <h6 class="menu-header-subtitle">You have
                                                    <b>21</b> unread messages
                                                </h6>
                                            </div>
                                        </div>
                                    </div>
                                    <ul class="tabs-animated-shadow tabs-animated nav nav-justified tabs-shadow-bordered p-3">
                                        <li class="nav-item">
                                            <a role="tab" class="nav-link active" data-bs-toggle="tab" href="#tab-messages-header">
                                                <span>Messages</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a role="tab" class="nav-link" data-bs-toggle="tab" href="#tab-events-header">
                                                <span>Events</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a role="tab" class="nav-link" data-bs-toggle="tab" href="#tab-errors-header">
                                                <span>System Errors</span>
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="tab-messages-header" role="tabpanel">
                                            <div class="scroll-area-sm">
                                                <div class="scrollbar-container">
                                                    <div class="p-3">
                                                        <div class="notifications-box">
                                                            <div class="vertical-time-simple vertical-without-time vertical-timeline vertical-timeline--one-column">
                                                                <div class="vertical-timeline-item dot-danger vertical-timeline-element">
                                                                    <div>
                                                                        <span class="vertical-timeline-element-icon bounce-in"></span>
                                                                        <div class="vertical-timeline-element-content bounce-in">
                                                                            <h4 class="timeline-title">All Hands Meeting</h4>
                                                                            <span class="vertical-timeline-element-date"></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="vertical-timeline-item dot-warning vertical-timeline-element">
                                                                    <div>
                                                                        <span class="vertical-timeline-element-icon bounce-in"></span>
                                                                        <div class="vertical-timeline-element-content bounce-in">
                                                                            <p>Yet another one, at
                                                                                <span class="text-success">15:00 PM</span>
                                                                            </p>
                                                                            <span class="vertical-timeline-element-date"></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="vertical-timeline-item dot-success vertical-timeline-element">
                                                                    <div>
                                                                        <span class="vertical-timeline-element-icon bounce-in"></span>
                                                                        <div class="vertical-timeline-element-content bounce-in">
                                                                            <h4 class="timeline-title">
                                                                                Build the production release
                                                                                <span class="badge bg-danger ms-2">NEW</span>
                                                                            </h4>
                                                                            <span class="vertical-timeline-element-date"></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="vertical-timeline-item dot-primary vertical-timeline-element">
                                                                    <div>
                                                                        <span class="vertical-timeline-element-icon bounce-in"></span>
                                                                        <div class="vertical-timeline-element-content bounce-in">
                                                                            <h4 class="timeline-title">
                                                                                Something not important
                                                                                <div class="avatar-wrapper mt-2 avatar-wrapper-overlap">
                                                                                    <div class="avatar-icon-wrapper avatar-icon-sm">
                                                                                        <div class="avatar-icon">
                                                                                            {{-- <img src="images/avatars/1.jpg" alt=""> --}}
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="avatar-icon-wrapper avatar-icon-sm">
                                                                                        <div class="avatar-icon">
                                                                                            {{-- <img src="images/avatars/2.jpg" alt=""> --}}
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="avatar-icon-wrapper avatar-icon-sm">
                                                                                        <div class="avatar-icon">
                                                                                            {{-- <img src="images/avatars/3.jpg" alt=""> --}}
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="avatar-icon-wrapper avatar-icon-sm">
                                                                                        <div class="avatar-icon">
                                                                                            {{-- <img src="images/avatars/4.jpg" alt=""> --}}
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="avatar-icon-wrapper avatar-icon-sm">
                                                                                        <div class="avatar-icon">
                                                                                            {{-- <img src="images/avatars/5.jpg" alt=""> --}}
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="avatar-icon-wrapper avatar-icon-sm">
                                                                                        <div class="avatar-icon">
                                                                                            {{-- <img src="images/avatars/9.jpg" alt=""> --}}
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="avatar-icon-wrapper avatar-icon-sm">
                                                                                        <div class="avatar-icon">
                                                                                            {{-- <img src="images/avatars/7.jpg" alt=""> --}}
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="avatar-icon-wrapper avatar-icon-sm">
                                                                                        <div class="avatar-icon">
                                                                                            {{-- <img src="images/avatars/8.jpg" alt=""> --}}
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="avatar-icon-wrapper avatar-icon-sm avatar-icon-add">
                                                                                        <div class="avatar-icon">
                                                                                            <i>+</i>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </h4>
                                                                            <span class="vertical-timeline-element-date"></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="vertical-timeline-item dot-info vertical-timeline-element">
                                                                    <div>
                                                                        <span class="vertical-timeline-element-icon bounce-in"></span>
                                                                        <div class="vertical-timeline-element-content bounce-in">
                                                                            <h4 class="timeline-title">This dot has an info state</h4>
                                                                            <span class="vertical-timeline-element-date"></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="vertical-timeline-item dot-danger vertical-timeline-element">
                                                                    <div>
                                                                        <span class="vertical-timeline-element-icon bounce-in"></span>
                                                                        <div class="vertical-timeline-element-content bounce-in">
                                                                            <h4 class="timeline-title">All Hands Meeting</h4>
                                                                            <span class="vertical-timeline-element-date"></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="vertical-timeline-item dot-warning vertical-timeline-element">
                                                                    <div>
                                                                        <span class="vertical-timeline-element-icon bounce-in"></span>
                                                                        <div class="vertical-timeline-element-content bounce-in">
                                                                            <p>Yet another one, at
                                                                                <span class="text-success">15:00 PM</span>
                                                                            </p>
                                                                            <span class="vertical-timeline-element-date"></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="vertical-timeline-item dot-success vertical-timeline-element">
                                                                    <div>
                                                                        <span class="vertical-timeline-element-icon bounce-in"></span>
                                                                        <div class="vertical-timeline-element-content bounce-in">
                                                                            <h4 class="timeline-title">
                                                                                Build the production release
                                                                                <span class="badge bg-danger ms-2">NEW</span>
                                                                            </h4>
                                                                            <span class="vertical-timeline-element-date"></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="vertical-timeline-item dot-dark vertical-timeline-element">
                                                                    <div>
                                                                        <span class="vertical-timeline-element-icon bounce-in"></span>
                                                                        <div class="vertical-timeline-element-content bounce-in">
                                                                            <h4 class="timeline-title">This dot has a dark state</h4>
                                                                            <span class="vertical-timeline-element-date"></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="tab-events-header" role="tabpanel">
                                            <div class="scroll-area-sm">
                                                <div class="scrollbar-container">
                                                    <div class="p-3">
                                                        <div class="vertical-without-time vertical-timeline vertical-timeline--animate vertical-timeline--one-column">
                                                            <div class="vertical-timeline-item vertical-timeline-element">
                                                                <div>
                                                                    <span class="vertical-timeline-element-icon bounce-in">
                                                                        <i class="badge badge-dot badge-dot-xl bg-success"></i>
                                                                    </span>
                                                                    <div class="vertical-timeline-element-content bounce-in">
                                                                        <h4 class="timeline-title">All Hands Meeting</h4>
                                                                        <p>
                                                                            Lorem ipsum dolor sic amet, today at
                                                                            <a href="javascript:void(0);">12:00 PM</a>
                                                                        </p>
                                                                        <span class="vertical-timeline-element-date"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="vertical-timeline-item vertical-timeline-element">
                                                                <div>
                                                                    <span class="vertical-timeline-element-icon bounce-in">
                                                                        <i class="badge badge-dot badge-dot-xl bg-warning"></i>
                                                                    </span>
                                                                    <div class="vertical-timeline-element-content bounce-in">
                                                                        <p>Another meeting today, at
                                                                            <b class="text-danger">12:00 PM</b>
                                                                        </p>
                                                                        <p>Yet another one, at
                                                                            <span class="text-success">15:00 PM</span>
                                                                        </p>
                                                                        <span class="vertical-timeline-element-date"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="vertical-timeline-item vertical-timeline-element">
                                                                <div>
                                                                    <span class="vertical-timeline-element-icon bounce-in">
                                                                        <i class="badge badge-dot badge-dot-xl bg-danger"></i>
                                                                    </span>
                                                                    <div class="vertical-timeline-element-content bounce-in">
                                                                        <h4 class="timeline-title">Build the production release</h4>
                                                                        <p>
                                                                            Lorem ipsum dolor sit amit,consectetur eiusmdd tempor incididunt ut
                                                                            labore et dolore magna elit enim at minim veniam quis nostrud
                                                                        </p>
                                                                        <span class="vertical-timeline-element-date"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="vertical-timeline-item vertical-timeline-element">
                                                                <div>
                                                                    <span class="vertical-timeline-element-icon bounce-in">
                                                                        <i class="badge badge-dot badge-dot-xl bg-primary"></i>
                                                                    </span>
                                                                    <div class="vertical-timeline-element-content bounce-in">
                                                                        <h4 class="timeline-title text-success">Something not important</h4>
                                                                        <p>Lorem ipsum dolor sit amit,consectetur elit enim at minim veniam quis nostrud</p>
                                                                        <span class="vertical-timeline-element-date"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="vertical-timeline-item vertical-timeline-element">
                                                                <div>
                                                                    <span class="vertical-timeline-element-icon bounce-in">
                                                                        <i class="badge badge-dot badge-dot-xl bg-success"></i>
                                                                    </span>
                                                                    <div class="vertical-timeline-element-content bounce-in">
                                                                        <h4 class="timeline-title">All Hands Meeting</h4>
                                                                        <p>
                                                                            Lorem ipsum dolor sic amet, today at
                                                                            <a href="javascript:void(0);">12:00 PM</a>
                                                                        </p>
                                                                        <span class="vertical-timeline-element-date"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="vertical-timeline-item vertical-timeline-element">
                                                                <div>
                                                                    <span class="vertical-timeline-element-icon bounce-in">
                                                                        <i class="badge badge-dot badge-dot-xl bg-warning"></i>
                                                                    </span>
                                                                    <div class="vertical-timeline-element-content bounce-in">
                                                                        <p>Another meeting today, at
                                                                            <b class="text-danger">12:00 PM</b>
                                                                        </p>
                                                                        <p>Yet another one, at
                                                                            <span class="text-success">15:00 PM</span>
                                                                        </p>
                                                                        <span class="vertical-timeline-element-date"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="vertical-timeline-item vertical-timeline-element">
                                                                <div>
                                                                    <span class="vertical-timeline-element-icon bounce-in">
                                                                        <i class="badge badge-dot badge-dot-xl bg-danger"></i>
                                                                    </span>
                                                                    <div class="vertical-timeline-element-content bounce-in">
                                                                        <h4 class="timeline-title">Build the production release</h4>
                                                                        <p>
                                                                            Lorem ipsum dolor sit amit,consectetur eiusmdd tempor incididunt ut
                                                                            labore et dolore magna elit enim at minim veniam quis nostrud
                                                                        </p>
                                                                        <span class="vertical-timeline-element-date"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="vertical-timeline-item vertical-timeline-element">
                                                                <div>
                                                                    <span class="vertical-timeline-element-icon bounce-in">
                                                                        <i class="badge badge-dot badge-dot-xl bg-primary"></i>
                                                                    </span>
                                                                    <div class="vertical-timeline-element-content bounce-in">
                                                                        <h4 class="timeline-title text-success">Something not important</h4>
                                                                        <p>Lorem ipsum dolor sit amit,consectetur elit enim at minim veniam quis nostrud</p>
                                                                        <span class="vertical-timeline-element-date"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="tab-errors-header" role="tabpanel">
                                            <div class="scroll-area-sm">
                                                <div class="scrollbar-container">
                                                    <div class="no-results pt-3 pb-0">
                                                        <div class="swal2-icon swal2-success swal2-animate-success-icon">
                                                            <div class="swal2-success-circular-line-left" style="background-color: rgb(255, 255, 255);"></div>
                                                            <span class="swal2-success-line-tip"></span>
                                                            <span class="swal2-success-line-long"></span>
                                                            <div class="swal2-success-ring"></div>
                                                            <div class="swal2-success-fix" style="background-color: rgb(255, 255, 255);"></div>
                                                            <div class="swal2-success-circular-line-right" style="background-color: rgb(255, 255, 255);"></div>
                                                        </div>
                                                        <div class="results-subtitle">All caught up!</div>
                                                        <div class="results-title">There are no system errors!</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <ul class="nav flex-column">
                                        <li class="nav-item-divider nav-item"></li>
                                        <li class="nav-item-btn text-center nav-item">
                                            <button class="btn-shadow btn-wide btn-pill btn btn-focus btn-sm">View Latest Changes</button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            
                        </div>
                        <div class="header-btn-lg pe-0">
                            <div class="widget-content p-0">
                                <div class="widget-content-wrapper">
                                    <div class="widget-content-left">
                                        <div class="btn-group">
                                            <a data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="p-0 btn"> 
                                                @if (Auth::user()->img == null)
                                                <img src="{{ asset('assets/images/default-image.jpg') }}" height="32px"
                                                    width="32px" alt="" class="rounded-circle header-profile-user">
                                            @else
                                                <img src="{{ asset('storage/person/' . Auth::user()->img) }}" height="32px"
                                                    width="32px" alt="" class="rounded-circle header-profile-user">
                                            @endif
                                                <i class="fa fa-angle-down ms-2 opacity-8"></i>
                                            </a>
                                            <div tabindex="-1" role="menu" aria-hidden="true"
                                                class="rm-pointers dropdown-menu-lg dropdown-menu dropdown-menu-right">
                                                <div class="dropdown-menu-header">
                                                    <div class="dropdown-menu-header-inner bg-info">
                                                        <div class="menu-header-image opacity-2" style="background-image: url('images/dropdown-header/city3.jpg');"></div>
                                                        <div class="menu-header-content text-start">
                                                            <div class="widget-content p-0">
                                                                <div class="widget-content-wrapper">
                                                                    <div class="widget-content-left me-3"> 
                                                                            @if (Auth::user()->img == null)
                                                                            <img src="{{ asset('assets/images/default-image.jpg') }}" height="32px"
                                                                                width="32px" alt="" class="rounded-circle header-profile-user">
                                                                        @else
                                                                            <img src="{{ asset('storage/person/' . Auth::user()->img) }}" height="32px"
                                                                                width="32px" alt="" class="rounded-circle header-profile-user">
                                                                        @endif
                                                                    </div>
                                                                    <div class="widget-content-left">
                                                                        <div class="widget-heading">
                                                                            {{ Auth::user()->fname }} {{ Auth::user()->lname }}
                                                                        </div>
                                                                        <div class="widget-subheading opacity-8">
                                                                            {{ Auth::user()->position_name }}
                                                                        </div>
                                                                    </div>
                                                                    <div class="widget-content-right me-2">
                                                                        <a class="btn-pill btn-shadow btn-shine btn btn-focus" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                                            Logout
                                                                        </a>
                                                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                                            @csrf
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="scroll-area-xs" style="height: 10px;">
                                                    {{-- <div class="scrollbar-container ps">
                                                        <ul class="nav flex-column"> --}}
                                                            {{-- <li class="nav-item-header nav-item">Activity</li> --}}
                                                            {{-- <li class="nav-item">
                                                                <a href="javascript:void(0);" class="nav-link">
                                                                    Chat
                                                                    <div class="ms-auto badge rounded-pill bg-info">8</div>
                                                                </a>
                                                            </li> --}}
                                                            {{-- <li class="nav-item">
                                                                <a href="javascript:void(0);" class="nav-link">เปลี่ยนรหัสผ่าน</a>
                                                            </li> --}}
                                                            {{-- <li class="nav-item-header nav-item">
                                                                My Account
                                                            </li> --}}
                                                            {{-- <li class="nav-item">
                                                                <a href="javascript:void(0);" class="nav-link">
                                                                    Settings
                                                                    <div class="ms-auto badge bg-success">New</div>
                                                                </a>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a href="javascript:void(0);" class="nav-link">
                                                                    Messages
                                                                    <div class="ms-auto badge bg-warning">512</div>
                                                                </a>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a href="javascript:void(0);" class="nav-link">Logs</a>
                                                            </li> --}}
                                                        {{-- </ul>
                                                    </div> --}}
                                                </div>
                                                <ul class="nav flex-column">
                                                    <li class="nav-item-divider mb-0 nav-item"></li>
                                                </ul>
                                                <div class="grid-menu grid-menu-2col">
                                                    <div class="g-0 row">
                                                        <div class="col-sm-6">
                                                            <button class="btn-icon-vertical btn-transition btn-transition-alt pt-2 pb-2 btn btn-outline-warning">
                                                                <i class="pe-7s-chat icon-gradient bg-amy-crisp btn-icon-wrapper mb-2"></i>
                                                                เปลี่ยนรหัสผ่าน
                                                            </button>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <button class="btn-icon-vertical btn-transition btn-transition-alt pt-2 pb-2 btn btn-outline-danger">
                                                                <i class="pe-7s-ticket icon-gradient bg-love-kiss btn-icon-wrapper mb-2"></i>
                                                                <b>เปลี่ยนรหัสผ่าน</b>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="widget-content-left  ms-3 header-user-info">
                                        <div class="widget-heading"> {{ Auth::user()->fname }} {{ Auth::user()->lname }}</div>
                                        <div class="widget-subheading">  {{ Auth::user()->position_name }}</div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="header-btn-lg">
                            <button type="button" class="hamburger hamburger--elastic open-right-drawer">
                                <span class="hamburger-box">
                                    <span class="hamburger-inner"></span>
                                </span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="ui-theme-settings">
                <button type="button" id="TooltipDemo" class="btn-open-options btn btn-warning">
                    <i class="fa fa-cog fa-w-16 fa-spin fa-2x"></i>
                </button>
                <div class="theme-settings__inner">
                    <div class="scrollbar-container">
                        <div class="theme-settings__options-wrapper">
                            <h3 class="themeoptions-heading">Layout Options</h3>
                            <div class="p-3">
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <div class="widget-content p-0">
                                            <div class="widget-content-wrapper">
                                                <div class="widget-content-left me-3">
                                                    <div class="switch has-switch switch-container-class" data-class="fixed-header">
                                                        <div class="switch-animate switch-on">
                                                            <input type="checkbox" checked
                                                                data-toggle="toggle" data-onstyle="success">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="widget-content-left">
                                                    <div class="widget-heading">Fixed Header</div>
                                                    <div class="widget-subheading">Makes the header top fixed, always visible!</div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="widget-content p-0">
                                            <div class="widget-content-wrapper">
                                                <div class="widget-content-left me-3">
                                                    <div class="switch has-switch switch-container-class" data-class="fixed-sidebar">
                                                        <div class="switch-animate switch-on">
                                                            <input type="checkbox" checked
                                                                data-toggle="toggle" data-onstyle="success">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="widget-content-left">
                                                    <div class="widget-heading">Fixed Sidebar</div>
                                                    <div class="widget-subheading">Makes the sidebar left fixed, always visible!</div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="widget-content p-0">
                                            <div class="widget-content-wrapper">
                                                <div class="widget-content-left me-3">
                                                    <div class="switch has-switch switch-container-class" data-class="fixed-footer">
                                                        <div class="switch-animate switch-off">
                                                            <input type="checkbox" data-toggle="toggle" data-onstyle="success">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="widget-content-left">
                                                    <div class="widget-heading">Fixed Footer</div>
                                                    <div class="widget-subheading">Makes the app footer bottom fixed, always visible!</div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <h3 class="themeoptions-heading">
                                <div> Header Options</div>
                                <button type="button" class="btn-pill btn-shadow btn-wide ms-auto btn btn-focus btn-sm switch-header-cs-class" data-class="">
                                    Restore Default
                                </button>
                            </h3>
                            <div class="p-3">
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <h5 class="pb-2">Choose Color Scheme</h5>
                                        <div class="theme-settings-swatches">
                                            <div class="swatch-holder bg-primary switch-header-cs-class" data-class="bg-primary header-text-light"></div>
                                            <div class="swatch-holder bg-secondary switch-header-cs-class" data-class="bg-secondary header-text-light"></div>
                                            <div class="swatch-holder bg-success switch-header-cs-class" data-class="bg-success header-text-light"></div>
                                            <div class="swatch-holder bg-info switch-header-cs-class" data-class="bg-info header-text-light"></div>
                                            <div class="swatch-holder bg-warning switch-header-cs-class" data-class="bg-warning header-text-dark"></div>
                                            <div class="swatch-holder bg-danger switch-header-cs-class" data-class="bg-danger header-text-light"></div>
                                            <div class="swatch-holder bg-light switch-header-cs-class" data-class="bg-light header-text-dark"></div>
                                            <div class="swatch-holder bg-dark switch-header-cs-class" data-class="bg-dark header-text-light"></div>
                                            <div class="swatch-holder bg-focus switch-header-cs-class" data-class="bg-focus header-text-light"></div>
                                            <div class="swatch-holder bg-alternate switch-header-cs-class" data-class="bg-alternate header-text-light"></div>
                                            <div class="divider"></div>
                                            <div class="swatch-holder bg-vicious-stance switch-header-cs-class" data-class="bg-vicious-stance header-text-light"></div>
                                            <div class="swatch-holder bg-midnight-bloom switch-header-cs-class" data-class="bg-midnight-bloom header-text-light"></div>
                                            <div class="swatch-holder bg-night-sky switch-header-cs-class" data-class="bg-night-sky header-text-light"></div>
                                            <div class="swatch-holder bg-slick-carbon switch-header-cs-class" data-class="bg-slick-carbon header-text-light"></div>
                                            <div class="swatch-holder bg-asteroid switch-header-cs-class" data-class="bg-asteroid header-text-light"></div>
                                            <div class="swatch-holder bg-royal switch-header-cs-class" data-class="bg-royal header-text-light"></div>
                                            <div class="swatch-holder bg-warm-flame switch-header-cs-class" data-class="bg-warm-flame header-text-dark"></div>
                                            <div class="swatch-holder bg-night-fade switch-header-cs-class" data-class="bg-night-fade header-text-dark"></div>
                                            <div class="swatch-holder bg-sunny-morning switch-header-cs-class" data-class="bg-sunny-morning header-text-dark"></div>
                                            <div class="swatch-holder bg-tempting-azure switch-header-cs-class" data-class="bg-tempting-azure header-text-dark"></div>
                                            <div class="swatch-holder bg-amy-crisp switch-header-cs-class" data-class="bg-amy-crisp header-text-dark"></div>
                                            <div class="swatch-holder bg-heavy-rain switch-header-cs-class" data-class="bg-heavy-rain header-text-dark"></div>
                                            <div class="swatch-holder bg-mean-fruit switch-header-cs-class" data-class="bg-mean-fruit header-text-dark"></div>
                                            <div class="swatch-holder bg-malibu-beach switch-header-cs-class" data-class="bg-malibu-beach header-text-light"></div>
                                            <div class="swatch-holder bg-deep-blue switch-header-cs-class" data-class="bg-deep-blue header-text-dark"></div>
                                            <div class="swatch-holder bg-ripe-malin switch-header-cs-class" data-class="bg-ripe-malin header-text-light"></div>
                                            <div class="swatch-holder bg-arielle-smile switch-header-cs-class" data-class="bg-arielle-smile header-text-light"></div>
                                            <div class="swatch-holder bg-plum-plate switch-header-cs-class" data-class="bg-plum-plate header-text-light"></div>
                                            <div class="swatch-holder bg-happy-fisher switch-header-cs-class" data-class="bg-happy-fisher header-text-dark"></div>
                                            <div class="swatch-holder bg-happy-itmeo switch-header-cs-class" data-class="bg-happy-itmeo header-text-light"></div>
                                            <div class="swatch-holder bg-mixed-hopes switch-header-cs-class" data-class="bg-mixed-hopes header-text-light"></div>
                                            <div class="swatch-holder bg-strong-bliss switch-header-cs-class" data-class="bg-strong-bliss header-text-light"></div>
                                            <div class="swatch-holder bg-grow-early switch-header-cs-class" data-class="bg-grow-early header-text-light"></div>
                                            <div class="swatch-holder bg-love-kiss switch-header-cs-class" data-class="bg-love-kiss header-text-light"></div>
                                            <div class="swatch-holder bg-premium-dark switch-header-cs-class" data-class="bg-premium-dark header-text-light"></div>
                                            <div class="swatch-holder bg-happy-green switch-header-cs-class" data-class="bg-happy-green header-text-light"></div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <h3 class="themeoptions-heading">
                                <div>Sidebar Options</div>
                                <button type="button" class="btn-pill btn-shadow btn-wide ms-auto btn btn-focus btn-sm switch-sidebar-cs-class" data-class="">
                                    Restore Default
                                </button>
                            </h3>
                            <div class="p-3">
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <h5 class="pb-2">Choose Color Scheme</h5>
                                        <div class="theme-settings-swatches">
                                            <div class="swatch-holder bg-primary switch-sidebar-cs-class" data-class="bg-primary sidebar-text-light"></div>
                                            <div class="swatch-holder bg-secondary switch-sidebar-cs-class" data-class="bg-secondary sidebar-text-light"></div>
                                            <div class="swatch-holder bg-success switch-sidebar-cs-class" data-class="bg-success sidebar-text-dark"></div>
                                            <div class="swatch-holder bg-info switch-sidebar-cs-class" data-class="bg-info sidebar-text-dark"></div>
                                            <div class="swatch-holder bg-warning switch-sidebar-cs-class" data-class="bg-warning sidebar-text-dark"></div>
                                            <div class="swatch-holder bg-danger switch-sidebar-cs-class" data-class="bg-danger sidebar-text-light"></div>
                                            <div class="swatch-holder bg-light switch-sidebar-cs-class" data-class="bg-light sidebar-text-dark"></div>
                                            <div class="swatch-holder bg-dark switch-sidebar-cs-class" data-class="bg-dark sidebar-text-light"></div>
                                            <div class="swatch-holder bg-focus switch-sidebar-cs-class" data-class="bg-focus sidebar-text-light"></div>
                                            <div class="swatch-holder bg-alternate switch-sidebar-cs-class" data-class="bg-alternate sidebar-text-light"></div>
                                            <div class="divider"></div>
                                            <div class="swatch-holder bg-vicious-stance switch-sidebar-cs-class" data-class="bg-vicious-stance sidebar-text-light"></div>
                                            <div class="swatch-holder bg-midnight-bloom switch-sidebar-cs-class" data-class="bg-midnight-bloom sidebar-text-light"></div>
                                            <div class="swatch-holder bg-night-sky switch-sidebar-cs-class" data-class="bg-night-sky sidebar-text-light"></div>
                                            <div class="swatch-holder bg-slick-carbon switch-sidebar-cs-class" data-class="bg-slick-carbon sidebar-text-light"></div>
                                            <div class="swatch-holder bg-asteroid switch-sidebar-cs-class" data-class="bg-asteroid sidebar-text-light"></div>
                                            <div class="swatch-holder bg-royal switch-sidebar-cs-class" data-class="bg-royal sidebar-text-light"></div>
                                            <div class="swatch-holder bg-warm-flame switch-sidebar-cs-class" data-class="bg-warm-flame sidebar-text-dark"></div>
                                            <div class="swatch-holder bg-night-fade switch-sidebar-cs-class" data-class="bg-night-fade sidebar-text-dark"></div>
                                            <div class="swatch-holder bg-sunny-morning switch-sidebar-cs-class" data-class="bg-sunny-morning sidebar-text-dark"></div>
                                            <div class="swatch-holder bg-tempting-azure switch-sidebar-cs-class" data-class="bg-tempting-azure sidebar-text-dark"></div>
                                            <div class="swatch-holder bg-amy-crisp switch-sidebar-cs-class" data-class="bg-amy-crisp sidebar-text-dark"></div>
                                            <div class="swatch-holder bg-heavy-rain switch-sidebar-cs-class" data-class="bg-heavy-rain sidebar-text-dark"></div>
                                            <div class="swatch-holder bg-mean-fruit switch-sidebar-cs-class" data-class="bg-mean-fruit sidebar-text-dark"></div>
                                            <div class="swatch-holder bg-malibu-beach switch-sidebar-cs-class" data-class="bg-malibu-beach sidebar-text-light"></div>
                                            <div class="swatch-holder bg-deep-blue switch-sidebar-cs-class" data-class="bg-deep-blue sidebar-text-dark"></div>
                                            <div class="swatch-holder bg-ripe-malin switch-sidebar-cs-class" data-class="bg-ripe-malin sidebar-text-light"></div>
                                            <div class="swatch-holder bg-arielle-smile switch-sidebar-cs-class" data-class="bg-arielle-smile sidebar-text-light"></div>
                                            <div class="swatch-holder bg-plum-plate switch-sidebar-cs-class" data-class="bg-plum-plate sidebar-text-light"></div>
                                            <div class="swatch-holder bg-happy-fisher switch-sidebar-cs-class" data-class="bg-happy-fisher sidebar-text-dark"></div>
                                            <div class="swatch-holder bg-happy-itmeo switch-sidebar-cs-class" data-class="bg-happy-itmeo sidebar-text-light"></div>
                                            <div class="swatch-holder bg-mixed-hopes switch-sidebar-cs-class" data-class="bg-mixed-hopes sidebar-text-light"></div>
                                            <div class="swatch-holder bg-strong-bliss switch-sidebar-cs-class" data-class="bg-strong-bliss sidebar-text-light"></div>
                                            <div class="swatch-holder bg-grow-early switch-sidebar-cs-class" data-class="bg-grow-early sidebar-text-light"></div>
                                            <div class="swatch-holder bg-love-kiss switch-sidebar-cs-class" data-class="bg-love-kiss sidebar-text-light"></div>
                                            <div class="swatch-holder bg-premium-dark switch-sidebar-cs-class" data-class="bg-premium-dark sidebar-text-light"></div>
                                            <div class="swatch-holder bg-happy-green switch-sidebar-cs-class" data-class="bg-happy-green sidebar-text-light"></div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <h3 class="themeoptions-heading">
                                <div>Main Content Options</div>
                                <button type="button" class="btn-pill btn-shadow btn-wide ms-auto active btn btn-focus btn-sm">Restore Default</button>
                            </h3>
                            <div class="p-3">
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <h5 class="pb-2">Page Section Tabs</h5>
                                        <div class="theme-settings-swatches">
                                            <div role="group" class="mt-2 btn-group">
                                                <button type="button" class="btn-wide btn-shadow btn-primary btn btn-secondary switch-theme-class" data-class="body-tabs-line"> Line</button>
                                                <button type="button" class="btn-wide btn-shadow btn-primary active btn btn-secondary switch-theme-class" data-class="body-tabs-shadow"> Shadow</button>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <h5 class="pb-2">
                                            Light Color Schemes
                                        </h5>
                                        <div class="theme-settings-swatches">
                                            <div role="group" class="mt-2 btn-group">
                                                <button type="button" class="btn-wide btn-shadow btn-primary active btn btn-secondary switch-theme-class" data-class="app-theme-white"> White Theme</button>
                                                <button type="button" class="btn-wide btn-shadow btn-primary btn btn-secondary switch-theme-class" data-class="app-theme-gray"> Gray Theme</button>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
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
                                <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
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
                            <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
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
                                <li>
                                    <a href="#">
                                        <i class="metismenu-icon pe-7s-rocket"></i>
                                        Dashboards
                                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                                    </a>
                                    <ul>
                                        <li>
                                            <a href="{{url('warehouse/warehouse_index')}}"> 
                                                <i class="metismenu-icon"></i>
                                                ตรวจรับวัสดุ
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{url('warehouse/warehouse_pay')}}"> 
                                                <i class="metismenu-icon"></i>
                                                เบิกจ่ายพัสดุ
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="metismenu-icon"></i>
                                                ตั่งค่า
                                                <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                                            </a>
                                            <ul>
                                                <li>
                                                    <a href="{{url("warehouse/warehouse_inven")}}">
                                                        <i class="metismenu-icon"></i>
                                                        คลังวัสดุ
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="{{url("warehouse/warehouse_vendor")}}">
                                                        <i class="metismenu-icon"></i>
                                                        ตัวแทนจำหน่าย
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                        
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
                                            <a aria-haspopup="true" aria-expanded="false" data-bs-toggle="dropdown" class="dot-btn-wrapper">
                                                <i class="dot-btn-icon lnr-bullhorn icon-gradient bg-mean-fruit"></i>
                                                <div class="badge badge-dot badge-abs badge-dot-sm bg-danger">Notifications</div>
                                            </a>
                                            <div tabindex="-1" role="menu" aria-hidden="true"
                                                class="dropdown-menu-xl rm-pointers dropdown-menu">
                                                <div class="dropdown-menu-header mb-0">
                                                    <div class="dropdown-menu-header-inner bg-deep-blue">
                                                        <div class="menu-header-image opacity-1" style="background-image: url('images/dropdown-header/city3.jpg');"></div>
                                                        <div class="menu-header-content text-dark">
                                                            <h5 class="menu-header-title">Notifications</h5>
                                                            <h6 class="menu-header-subtitle">You have
                                                                <b>21</b> unread messages
                                                            </h6>
                                                        </div>
                                                    </div>
                                                </div>
                                                <ul class="tabs-animated-shadow tabs-animated nav nav-justified tabs-shadow-bordered p-3">
                                                    <li class="nav-item">
                                                        <a role="tab" class="nav-link active" data-bs-toggle="tab" href="#tab-messages-header1">
                                                            <span>Messages</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a role="tab" class="nav-link" data-bs-toggle="tab"  href="#tab-events-header1">
                                                            <span>Events</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a role="tab" class="nav-link" data-bs-toggle="tab" href="#tab-errors-header1">
                                                            <span>System Errors</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                                <div class="tab-content">
                                                    <div class="tab-pane active" id="tab-messages-header1" role="tabpanel">
                                                        <div class="scroll-area-sm">
                                                            <div class="scrollbar-container">
                                                                <div class="p-3">
                                                                    <div class="notifications-box">
                                                                        <div class="vertical-time-simple vertical-without-time vertical-timeline vertical-timeline--one-column">
                                                                            <div class="vertical-timeline-item dot-danger vertical-timeline-element">
                                                                                <div>
                                                                                    <span class="vertical-timeline-element-icon bounce-in"></span>
                                                                                    <div class="vertical-timeline-element-content bounce-in">
                                                                                        <h4 class="timeline-title">All Hands Meeting</h4>
                                                                                        <span class="vertical-timeline-element-date"></span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="vertical-timeline-item dot-warning vertical-timeline-element">
                                                                                <div>
                                                                                    <span class="vertical-timeline-element-icon bounce-in"></span>
                                                                                    <div class="vertical-timeline-element-content bounce-in">
                                                                                        <p>
                                                                                            Yet another one, at
                                                                                            <span class="text-success">15:00 PM</span>
                                                                                        </p>
                                                                                        <span class="vertical-timeline-element-date"></span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="vertical-timeline-item dot-success vertical-timeline-element">
                                                                                <div>
                                                                                    <span class="vertical-timeline-element-icon bounce-in"></span>
                                                                                    <div class="vertical-timeline-element-content bounce-in">
                                                                                        <h4 class="timeline-title">
                                                                                            Build the production release
                                                                                            <span class="badge bg-danger ms-2">NEW</span>
                                                                                        </h4>
                                                                                        <span class="vertical-timeline-element-date"></span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="vertical-timeline-item dot-primary vertical-timeline-element">
                                                                                <div>
                                                                                    <span class="vertical-timeline-element-icon bounce-in"></span>
                                                                                    <div class="vertical-timeline-element-content bounce-in">
                                                                                        <h4 class="timeline-title">
                                                                                            Something not important
                                                                                            <div class="avatar-wrapper mt-2 avatar-wrapper-overlap">
                                                                                                <div class="avatar-icon-wrapper avatar-icon-sm">
                                                                                                    <div class="avatar-icon">
                                                                                                        {{-- <img src="images/avatars/1.jpg" alt=""> --}}
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="avatar-icon-wrapper avatar-icon-sm">
                                                                                                    <div class="avatar-icon">
                                                                                                        {{-- <img src="images/avatars/2.jpg" alt=""> --}}
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="avatar-icon-wrapper avatar-icon-sm">
                                                                                                    <div class="avatar-icon">
                                                                                                        {{-- <img src="images/avatars/3.jpg" alt=""> --}}
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="avatar-icon-wrapper avatar-icon-sm">
                                                                                                    <div class="avatar-icon">
                                                                                                        {{-- <img src="images/avatars/4.jpg" alt=""> --}}
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="avatar-icon-wrapper avatar-icon-sm">
                                                                                                    <div class="avatar-icon">
                                                                                                        {{-- <img src="images/avatars/5.jpg" alt=""> --}}
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="avatar-icon-wrapper avatar-icon-sm">
                                                                                                    <div class="avatar-icon">
                                                                                                        {{-- <img src="images/avatars/9.jpg" alt=""> --}}
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="avatar-icon-wrapper avatar-icon-sm">
                                                                                                    <div class="avatar-icon">
                                                                                                        {{-- <img src="images/avatars/7.jpg" alt=""> --}}
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="avatar-icon-wrapper avatar-icon-sm">
                                                                                                    <div class="avatar-icon">
                                                                                                        {{-- <img src="images/avatars/8.jpg" alt=""> --}}
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="avatar-icon-wrapper avatar-icon-sm avatar-icon-add">
                                                                                                    <div class="avatar-icon">
                                                                                                        <i>+</i>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </h4>
                                                                                        <span class="vertical-timeline-element-date"></span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="vertical-timeline-item dot-info vertical-timeline-element">
                                                                                <div>
                                                                                    <span class="vertical-timeline-element-icon bounce-in"></span>
                                                                                    <div class="vertical-timeline-element-content bounce-in">
                                                                                        <h4 class="timeline-title">This dot has an info state</h4>
                                                                                        <span class="vertical-timeline-element-date"></span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="vertical-timeline-item dot-danger vertical-timeline-element">
                                                                                <div>
                                                                                    <span class="vertical-timeline-element-icon bounce-in"></span>
                                                                                    <div class="vertical-timeline-element-content bounce-in">
                                                                                        <h4 class="timeline-title">All Hands Meeting</h4>
                                                                                        <span class="vertical-timeline-element-date"></span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="vertical-timeline-item dot-warning vertical-timeline-element">
                                                                                <div>
                                                                                    <span class="vertical-timeline-element-icon bounce-in"></span>
                                                                                    <div class="vertical-timeline-element-content bounce-in">
                                                                                        <p>
                                                                                            Yet another one, at
                                                                                            <span class="text-success">15:00 PM</span>
                                                                                        </p>
                                                                                        <span class="vertical-timeline-element-date"></span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="vertical-timeline-item dot-success vertical-timeline-element">
                                                                                <div>
                                                                                    <span class="vertical-timeline-element-icon bounce-in"></span>
                                                                                    <div class="vertical-timeline-element-content bounce-in">
                                                                                        <h4 class="timeline-title">
                                                                                            Build the production release
                                                                                            <span class="badge bg-danger ms-2">NEW</span>
                                                                                        </h4>
                                                                                        <span class="vertical-timeline-element-date"></span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="vertical-timeline-item dot-dark vertical-timeline-element">
                                                                                <div>
                                                                                    <span class="vertical-timeline-element-icon bounce-in"></span>
                                                                                    <div class="vertical-timeline-element-content bounce-in">
                                                                                        <h4 class="timeline-title">This dot has a dark state</h4>
                                                                                        <span class="vertical-timeline-element-date"></span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane" id="tab-events-header1" role="tabpanel">
                                                        <div class="scroll-area-sm">
                                                            <div class="scrollbar-container">
                                                                <div class="p-3">
                                                                    <div class="vertical-without-time vertical-timeline vertical-timeline--animate vertical-timeline--one-column">
                                                                        <div class="vertical-timeline-item vertical-timeline-element">
                                                                            <div>
                                                                                <span class="vertical-timeline-element-icon bounce-in">
                                                                                    <i class="badge badge-dot badge-dot-xl bg-success"></i>
                                                                                </span>
                                                                                <div class="vertical-timeline-element-content bounce-in">
                                                                                    <h4 class="timeline-title">All Hands Meeting</h4>
                                                                                    <p>
                                                                                        Lorem ipsum dolor sic amet, today at
                                                                                        <a href="javascript:void(0);">12:00 PM</a>
                                                                                    </p>
                                                                                    <span class="vertical-timeline-element-date"></span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="vertical-timeline-item vertical-timeline-element">
                                                                            <div>
                                                                                <span class="vertical-timeline-element-icon bounce-in">
                                                                                    <i class="badge badge-dot badge-dot-xl bg-warning"></i>
                                                                                </span>
                                                                                <div class="vertical-timeline-element-content bounce-in">
                                                                                    <p>
                                                                                        Another meeting today, at
                                                                                        <b class="text-danger">12:00 PM</b>
                                                                                    </p>
                                                                                    <p>Yet another one, at
                                                                                        <span class="text-success">15:00 PM</span>
                                                                                    </p>
                                                                                    <span class="vertical-timeline-element-date"></span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="vertical-timeline-item vertical-timeline-element">
                                                                            <div>
                                                                                <span class="vertical-timeline-element-icon bounce-in">
                                                                                    <i class="badge badge-dot badge-dot-xl bg-danger"></i>
                                                                                </span>
                                                                                <div class="vertical-timeline-element-content bounce-in">
                                                                                    <h4 class="timeline-title">Build the production release</h4>
                                                                                    <p>
                                                                                        Lorem ipsum dolor sit amit,consectetur eiusmdd tempor
                                                                                        incididunt ut labore et dolore magna elit enim at
                                                                                        minim veniam quis nostrud
                                                                                    </p>
                                                                                    <span class="vertical-timeline-element-date"></span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="vertical-timeline-item vertical-timeline-element">
                                                                            <div>
                                                                                <span class="vertical-timeline-element-icon bounce-in">
                                                                                    <i class="badge badge-dot badge-dot-xl bg-primary"></i>
                                                                                </span>
                                                                                <div class="vertical-timeline-element-content bounce-in">
                                                                                    <h4 class="timeline-title text-success">Something not important</h4>
                                                                                    <p>
                                                                                        Lorem ipsum dolor sit amit,consectetur elit enim at
                                                                                        minim veniam quis nostrud
                                                                                    </p>
                                                                                    <span class="vertical-timeline-element-date"></span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="vertical-timeline-item vertical-timeline-element">
                                                                            <div>
                                                                                <span class="vertical-timeline-element-icon bounce-in">
                                                                                    <i class="badge badge-dot badge-dot-xl bg-success"></i>
                                                                                </span>
                                                                                <div class="vertical-timeline-element-content bounce-in">
                                                                                    <h4 class="timeline-title">All Hands Meeting</h4>
                                                                                    <p>
                                                                                        Lorem ipsum dolor sic amet, today at
                                                                                        <a href="javascript:void(0);">12:00 PM</a>
                                                                                    </p>
                                                                                    <span class="vertical-timeline-element-date"></span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="vertical-timeline-item vertical-timeline-element">
                                                                            <div>
                                                                                <span class="vertical-timeline-element-icon bounce-in">
                                                                                    <i class="badge badge-dot badge-dot-xl bg-warning"></i>
                                                                                </span>
                                                                                <div class="vertical-timeline-element-content bounce-in">
                                                                                    <p>
                                                                                        Another meeting today, at
                                                                                        <b class="text-danger">12:00 PM</b>
                                                                                    </p>
                                                                                    <p>Yet another one, at
                                                                                        <span class="text-success">15:00 PM</span>
                                                                                    </p>
                                                                                    <span class="vertical-timeline-element-date"></span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="vertical-timeline-item vertical-timeline-element">
                                                                            <div>
                                                                                <span class="vertical-timeline-element-icon bounce-in">
                                                                                    <i class="badge badge-dot badge-dot-xl bg-danger"></i>
                                                                                </span>
                                                                                <div class="vertical-timeline-element-content bounce-in">
                                                                                    <h4 class="timeline-title">Build the production release</h4>
                                                                                    <p>
                                                                                        Lorem ipsum dolor sit amit,consectetur eiusmdd tempor
                                                                                        incididunt ut labore et dolore magna elit enim at
                                                                                        minim veniam quis nostrud
                                                                                    </p>
                                                                                    <span class="vertical-timeline-element-date"></span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="vertical-timeline-item vertical-timeline-element">
                                                                            <div>
                                                                                <span class="vertical-timeline-element-icon bounce-in">
                                                                                    <i class="badge badge-dot badge-dot-xl bg-primary"></i>
                                                                                </span>
                                                                                <div class="vertical-timeline-element-content bounce-in">
                                                                                    <h4 class="timeline-title text-success">Something not important</h4>
                                                                                    <p>
                                                                                        Lorem ipsum dolor sit amit,consectetur elit enim at
                                                                                        minim veniam quis nostrud
                                                                                    </p>
                                                                                    <span class="vertical-timeline-element-date"></span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane" id="tab-errors-header1" role="tabpanel">
                                                        <div class="scroll-area-sm">
                                                            <div class="scrollbar-container">
                                                                <div class="no-results pt-3 pb-0">
                                                                    <div class="swal2-icon swal2-success swal2-animate-success-icon">
                                                                        <div class="swal2-success-circular-line-left" style="background-color: rgb(255, 255, 255);"></div>
                                                                        <span class="swal2-success-line-tip"></span>
                                                                        <span class="swal2-success-line-long"></span>
                                                                        <div class="swal2-success-ring"></div>
                                                                        <div class="swal2-success-fix" style="background-color: rgb(255, 255, 255);"></div>
                                                                        <div class="swal2-success-circular-line-right" style="background-color: rgb(255, 255, 255);"></div>
                                                                    </div>
                                                                    <div class="results-subtitle">All caught up!</div>
                                                                    <div class="results-title">There are no system errors!</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <ul class="nav flex-column">
                                                    <li class="nav-item-divider nav-item"></li>
                                                    <li class="nav-item-btn text-center nav-item">
                                                        <button class="btn-shadow btn-wide btn-pill btn btn-focus btn-sm">View Latest Changes</button>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="dots-separator"></div>
                                        <div class="dropdown">
                                            <a class="dot-btn-wrapper" aria-haspopup="true" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="dot-btn-icon lnr-earth icon-gradient bg-happy-itmeo"></i>
                                            </a>
                                            <div tabindex="-1" role="menu" aria-hidden="true" class="rm-pointers dropdown-menu">
                                                <div class="dropdown-menu-header">
                                                    <div class="dropdown-menu-header-inner pt-4 pb-4 bg-focus">
                                                        <div class="menu-header-image opacity-05" style="background-image: url('images/dropdown-header/city2.jpg');"></div>
                                                        <div class="menu-header-content text-center text-white">
                                                            <h6 class="menu-header-subtitle mt-0"> Choose Language</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                                <h6 tabindex="-1" class="dropdown-header"> Popular Languages</h6>
                                                <button type="button" tabindex="0" class="dropdown-item">
                                                    <span class="me-3 opacity-8 flag large US"></span>
                                                    USA
                                                </button>
                                                <button type="button" tabindex="0" class="dropdown-item">
                                                    <span class="me-3 opacity-8 flag large CH"></span>
                                                    Switzerland
                                                </button>
                                                <button type="button" tabindex="0" class="dropdown-item">
                                                    <span class="me-3 opacity-8 flag large FR"></span>
                                                    France
                                                </button>
                                                <button type="button" tabindex="0" class="dropdown-item">
                                                    <span class="me-3 opacity-8 flag large ES"></span>
                                                    Spain
                                                </button>
                                                <div tabindex="-1" class="dropdown-divider"></div>
                                                <h6 tabindex="-1" class="dropdown-header">Others</h6>
                                                <button type="button" tabindex="0" class="dropdown-item active">
                                                    <span class="me-3 opacity-8 flag large DE"></span>
                                                    Germany
                                                </button>
                                                <button type="button" tabindex="0" class="dropdown-item">
                                                    <span class="me-3 opacity-8 flag large IT"></span>
                                                    Italy
                                                </button>
                                            </div>
                                        </div>
                                        <div class="dots-separator"></div>
                                        <div class="dropdown">
                                            <a class="dot-btn-wrapper dd-chart-btn-2" aria-haspopup="true" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="dot-btn-icon lnr-pie-chart icon-gradient bg-love-kiss"></i>
                                                <div class="badge badge-dot badge-abs badge-dot-sm bg-warning">Notifications</div>
                                            </a>
                                            <div tabindex="-1" role="menu" aria-hidden="true"
                                                class="dropdown-menu-xl rm-pointers dropdown-menu">
                                                <div class="dropdown-menu-header">
                                                    <div class="dropdown-menu-header-inner bg-premium-dark">
                                                        <div class="menu-header-image" style="background-image: url('images/dropdown-header/abstract4.jpg');"></div>
                                                        <div class="menu-header-content text-white">
                                                            <h5 class="menu-header-title">Users Online</h5>
                                                            <h6 class="menu-header-subtitle">Recent Account Activity Overview</h6>
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
                                                            <span>344k</span>
                                                        </div>
                                                        <div class="widget-subheading pt-2"> Profile views since last login</div>
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
                                            <a data-bs-placement="top" rel="popover-focus" data-offset="300" data-toggle="popover-custom" class="nav-link">
                                                Footer Menu
                                                <i class="fa fa-angle-up ms-2 opacity-8"></i>
                                            </a>
                                            <div class="rm-max-width rm-pointers">
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
                                                                                <div class="ms-auto badge rounded-pill bg-danger">5</div>
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
                                                                                <i class="nav-link-icon lnr-file-empty"></i>
                                                                                <span>Dashboards</span>
                                                                            </a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                                <div class="col-sm-6 col-xl-6">
                                                                    <ul class="nav flex-column">
                                                                        <li class="nav-item-header nav-item">Sales &amp; Marketing</li>
                                                                        <li class="nav-item">
                                                                            <a class="nav-link">Queues</a>
                                                                        </li>
                                                                        <li class="nav-item">
                                                                            <a class="nav-link">Resource Groups</a>
                                                                        </li>
                                                                        <li class="nav-item">
                                                                            <a class="nav-link">
                                                                                Goal Metrics
                                                                                <div class="ms-auto badge bg-warning">3</div>
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
                                            </div>
                                        </li>
                                        <li class="nav-item">
                                            <a data-bs-placement="top" rel="popover-focus" data-offset="300" data-toggle="popover-custom" class="nav-link">
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
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <div class="app-drawer-wrapper">
            <div class="drawer-nav-btn">
                <button type="button" class="hamburger hamburger--elastic is-active">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </button>
            </div>
            <div class="drawer-content-wrapper">
                <div class="scrollbar-container">
                    <h3 class="drawer-heading">Servers Status</h3>
                    <div class="drawer-section">
                        <div class="row">
                            <div class="col">
                                <div class="progress-box">
                                    <h4>Server Load 1</h4>
                                    <div class="circle-progress circle-progress-gradient-xl mx-auto">
                                        <small></small>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="progress-box">
                                    <h4>Server Load 2</h4>
                                    <div class="circle-progress circle-progress-success-xl mx-auto">
                                        <small></small>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="progress-box">
                                    <h4>Server Load 3</h4>
                                    <div class="circle-progress circle-progress-danger-xl mx-auto">
                                        <small></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="divider"></div>
                        <div class="mt-3">
                            <h5 class="text-center card-title">Live Statistics</h5>
                            <div id="sparkline-carousel-3"></div>
                            <div class="row">
                                <div class="col">
                                    <div class="widget-chart p-0">
                                        <div class="widget-chart-content">
                                            <div class="widget-numbers text-warning fsize-3">43</div>
                                            <div class="widget-subheading pt-1">Packages</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="widget-chart p-0">
                                        <div class="widget-chart-content">
                                            <div class="widget-numbers text-danger fsize-3">65</div>
                                            <div class="widget-subheading pt-1">Dropped</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="widget-chart p-0">
                                        <div class="widget-chart-content">
                                            <div class="widget-numbers text-success fsize-3">18</div>
                                            <div class="widget-subheading pt-1">Invalid</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="divider"></div>
                            <div class="text-center mt-2 d-block">
                                <button class="me-2 border-0 btn-transition btn btn-outline-danger">Escalate Issue</button>
                                <button class="border-0 btn-transition btn btn-outline-success">Support Center</button>
                            </div>
                        </div>
                    </div>
                    <h3 class="drawer-heading">File Transfers</h3>
                    <div class="drawer-section p-0">
                        <div class="files-box">
                            <ul class="list-group list-group-flush">
                                <li class="pt-2 pb-2 pe-2 list-group-item">
                                    <div class="widget-content p-0">
                                        <div class="widget-content-wrapper">
                                            <div class="widget-content-left opacity-6 fsize-2 me-3 text-primary center-elem">
                                                <i class="fa fa-file-alt"></i>
                                            </div>
                                            <div class="widget-content-left">
                                                <div class="widget-heading fw-normal">TPSReport.docx</div>
                                            </div>
                                            <div class="widget-content-right widget-content-actions">
                                                <button class="btn-icon btn-icon-only btn btn-link btn-sm">
                                                    <i class="fa fa-cloud-download-alt"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="pt-2 pb-2 pe-2 list-group-item">
                                    <div class="widget-content p-0">
                                        <div class="widget-content-wrapper">
                                            <div class="widget-content-left opacity-6 fsize-2 me-3 text-warning center-elem">
                                                <i class="fa fa-file-archive"></i>
                                            </div>
                                            <div class="widget-content-left">
                                                <div class="widget-heading fw-normal">Latest_photos.zip</div>
                                            </div>
                                            <div class="widget-content-right widget-content-actions">
                                                <button class="btn-icon btn-icon-only btn btn-link btn-sm">
                                                    <i class="fa fa-cloud-download-alt"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="pt-2 pb-2 pe-2 list-group-item">
                                    <div class="widget-content p-0">
                                        <div class="widget-content-wrapper">
                                            <div class="widget-content-left opacity-6 fsize-2 me-3 text-danger center-elem">
                                                <i class="fa fa-file-pdf"></i>
                                            </div>
                                            <div class="widget-content-left">
                                                <div class="widget-heading fw-normal">Annual Revenue.pdf</div>
                                            </div>
                                            <div class="widget-content-right widget-content-actions">
                                                <button class="btn-icon btn-icon-only btn btn-link btn-sm">
                                                    <i class="fa fa-cloud-download-alt"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="pt-2 pb-2 pe-2 list-group-item">
                                    <div class="widget-content p-0">
                                        <div class="widget-content-wrapper">
                                            <div class="widget-content-left opacity-6 fsize-2 me-3 text-success center-elem">
                                                <i class="fa fa-file-excel"></i>
                                            </div>
                                            <div class="widget-content-left">
                                                <div class="widget-heading fw-normal">Analytics_GrowthReport.xls</div>
                                            </div>
                                            <div class="widget-content-right widget-content-actions">
                                                <button class="btn-icon btn-icon-only btn btn-link btn-sm">
                                                    <i class="fa fa-cloud-download-alt"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <h3 class="drawer-heading">Tasks in Progress</h3>
                    <div class="drawer-section p-0">
                        <div class="todo-box">
                            <ul class="todo-list-wrapper list-group list-group-flush">
                                <li class="list-group-item">
                                    <div class="todo-indicator bg-warning"></div>
                                    <div class="widget-content p-0">
                                        <div class="widget-content-wrapper">
                                            <div class="widget-content-left me-2">
                                                <div class="custom-checkbox custom-control form-check">
                                                    <input type="checkbox" id="exampleCustomCheckbox1266" class="form-check-input">
                                                    <label class="form-label form-check-label" for="exampleCustomCheckbox1266">&nbsp;</label>
                                                </div>
                                            </div>
                                            <div class="widget-content-left">
                                                <div class="widget-heading">Wash the car
                                                    <div class="badge bg-danger ms-2">Rejected</div>
                                                </div>
                                                <div class="widget-subheading"><i>Written by Bob</i></div>
                                            </div>
                                            <div class="widget-content-right widget-content-actions">
                                                <button class="border-0 btn-transition btn btn-outline-success">
                                                    <i class="fa fa-check"></i>
                                                </button>
                                                <button class="border-0 btn-transition btn btn-outline-danger">
                                                    <i class="fa fa-trash-alt"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="todo-indicator bg-focus"></div>
                                    <div class="widget-content p-0">
                                        <div class="widget-content-wrapper">
                                            <div class="widget-content-left me-2">
                                                <div class="custom-checkbox custom-control form-check">
                                                    <input type="checkbox" id="exampleCustomCheckbox1666" class="form-check-input">
                                                    <label class="form-label form-check-label" for="exampleCustomCheckbox1666">&nbsp;</label>
                                                </div>
                                            </div>
                                            <div class="widget-content-left">
                                                <div class="widget-heading">Task with hover dropdown menu</div>
                                                <div class="widget-subheading">
                                                    <div>By Johnny
                                                        <div class="badge rounded-pill bg-info ms-2">NEW</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="widget-content-right widget-content-actions">
                                                <div class="d-inline-block dropdown">
                                                    <button type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="border-0 btn-transition btn btn-link">
                                                        <i class="fa fa-ellipsis-h"></i>
                                                    </button>
                                                    <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-right">
                                                        <h6 tabindex="-1" class="dropdown-header">Header</h6>
                                                        <button type="button" disabled="" tabindex="-1" class="disabled dropdown-item">Action</button>
                                                        <button type="button" tabindex="0" class="dropdown-item">Another Action</button>
                                                        <div tabindex="-1" class="dropdown-divider"></div>
                                                        <button type="button" tabindex="0" class="dropdown-item">Another Action</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="todo-indicator bg-primary"></div>
                                    <div class="widget-content p-0">
                                        <div class="widget-content-wrapper">
                                            <div class="widget-content-left me-2">
                                                <div class="custom-checkbox custom-control form-check">
                                                    <input type="checkbox" id="exampleCustomCheckbox4777" class="form-check-input">
                                                    <label class="form-label form-check-label" for="exampleCustomCheckbox4777">&nbsp;</label>
                                                </div>
                                            </div>
                                            <div class="widget-content-left flex2">
                                                <div class="widget-heading">Badge on the right task</div>
                                                <div class="widget-subheading">This task has show on hover actions!</div>
                                            </div>
                                            <div class="widget-content-right widget-content-actions">
                                                <button class="border-0 btn-transition btn btn-outline-success">
                                                    <i class="fa fa-check"></i>
                                                </button>
                                            </div>
                                            <div class="widget-content-right ms-3">
                                                <div class="badge rounded-pill bg-success">Latest Task</div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="todo-indicator bg-info"></div>
                                    <div class="widget-content p-0">
                                        <div class="widget-content-wrapper">
                                            <div class="widget-content-left me-2">
                                                <div class="custom-checkbox custom-control form-check">
                                                    <input type="checkbox" id="exampleCustomCheckbox2444" class="form-check-input">
                                                    <label class="form-label form-check-label" for="exampleCustomCheckbox2444">&nbsp;</label>
                                                </div>
                                            </div>
                                            <div class="widget-content-left me-3">
                                                <div class="widget-content-left">
                                                    {{-- <img width="42" class="rounded" src="assets/images/avatars/1.jpg" alt="" /> --}}
                                                </div>
                                            </div>
                                            <div class="widget-content-left">
                                                <div class="widget-heading">Go grocery shopping</div>
                                                <div class="widget-subheading">A short description ...</div>
                                            </div>
                                            <div class="widget-content-right widget-content-actions">
                                                <button class="border-0 btn-transition btn btn-sm btn-outline-success">
                                                    <i class="fa fa-check"></i>
                                                </button>
                                                <button class="border-0 btn-transition btn btn-sm btn-outline-danger">
                                                    <i class="fa fa-trash-alt"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="todo-indicator bg-success"></div>
                                    <div class="widget-content p-0">
                                        <div class="widget-content-wrapper">
                                            <div class="widget-content-left me-2">
                                                <div class="custom-checkbox custom-control form-check">
                                                    <input type="checkbox" id="exampleCustomCheckbox3222" class="form-check-input">
                                                    <label class="form-label form-check-label" for="exampleCustomCheckbox3222">&nbsp;</label>
                                                </div>
                                            </div>
                                            <div class="widget-content-left flex2">
                                                <div class="widget-heading">Development Task</div>
                                                <div class="widget-subheading">Finish React ToDo List App</div>
                                            </div>
                                            <div class="widget-content-right">
                                                <div class="badge bg-warning me-2">69</div>
                                            </div>
                                            <div class="widget-content-right">
                                                <button class="border-0 btn-transition btn btn-outline-success">
                                                    <i class="fa fa-check"></i>
                                                </button>
                                                <button class="border-0 btn-transition btn btn-outline-danger">
                                                    <i class="fa fa-trash-alt"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <h3 class="drawer-heading">Urgent Notifications</h3>
                    <div class="drawer-section">
                        <div class="notifications-box">
                            <div class="vertical-time-simple vertical-without-time vertical-timeline vertical-timeline--one-column">
                                <div class="vertical-timeline-item dot-danger vertical-timeline-element">
                                    <div>
                                        <span class="vertical-timeline-element-icon bounce-in"></span>
                                        <div class="vertical-timeline-element-content bounce-in">
                                            <h4 class="timeline-title">All Hands Meeting</h4>
                                            <span class="vertical-timeline-element-date"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="vertical-timeline-item dot-warning vertical-timeline-element">
                                    <div>
                                        <span class="vertical-timeline-element-icon bounce-in"></span>
                                        <div class="vertical-timeline-element-content bounce-in">
                                            <p>Yet another one, at
                                                <span class="text-success">15:00 PM</span>
                                            </p>
                                            <span class="vertical-timeline-element-date"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="vertical-timeline-item dot-success vertical-timeline-element">
                                    <div>
                                        <span class="vertical-timeline-element-icon bounce-in"></span>
                                        <div class="vertical-timeline-element-content bounce-in">
                                            <h4 class="timeline-title">
                                                Build the production release
                                                <div class="badge bg-danger ms-2">NEW</div>
                                            </h4>
                                            <span class="vertical-timeline-element-date"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="vertical-timeline-item dot-primary vertical-timeline-element">
                                    <div>
                                        <span class="vertical-timeline-element-icon bounce-in"></span>
                                        <div class="vertical-timeline-element-content bounce-in">
                                            <h4 class="timeline-title">
                                                Something not important
                                                <div class="avatar-wrapper mt-2 avatar-wrapper-overlap">
                                                    <div class="avatar-icon-wrapper avatar-icon-sm">
                                                        <div class="avatar-icon">
                                                            {{-- <img src="images/avatars/1.jpg" alt=""> --}}
                                                        </div>
                                                    </div>
                                                    <div class="avatar-icon-wrapper avatar-icon-sm">
                                                        <div class="avatar-icon">
                                                            {{-- <img src="images/avatars/2.jpg" alt=""> --}}
                                                        </div>
                                                    </div>
                                                    <div class="avatar-icon-wrapper avatar-icon-sm">
                                                        <div class="avatar-icon">
                                                            {{-- <img src="images/avatars/3.jpg" alt=""> --}}
                                                        </div>
                                                    </div>
                                                    <div class="avatar-icon-wrapper avatar-icon-sm">
                                                        <div class="avatar-icon">
                                                            {{-- <img src="images/avatars/4.jpg" alt=""> --}}
                                                        </div>
                                                    </div>
                                                    <div class="avatar-icon-wrapper avatar-icon-sm">
                                                        <div class="avatar-icon">
                                                            {{-- <img src="images/avatars/5.jpg" alt=""> --}}
                                                        </div>
                                                    </div>
                                                    <div class="avatar-icon-wrapper avatar-icon-sm">
                                                        <div class="avatar-icon">
                                                            {{-- <img src="images/avatars/6.jpg" alt=""> --}}
                                                        </div>
                                                    </div>
                                                    <div class="avatar-icon-wrapper avatar-icon-sm">
                                                        <div class="avatar-icon">
                                                            {{-- <img src="images/avatars/7.jpg" alt=""> --}}
                                                        </div>
                                                    </div>
                                                    <div class="avatar-icon-wrapper avatar-icon-sm">
                                                        <div class="avatar-icon">
                                                            {{-- <img src="images/avatars/8.jpg" alt=""> --}}
                                                        </div>
                                                    </div>
                                                    <div class="avatar-icon-wrapper avatar-icon-sm avatar-icon-add">
                                                        <div class="avatar-icon">
                                                            <i>+</i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </h4>
                                            <span class="vertical-timeline-element-date"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="vertical-timeline-item dot-info vertical-timeline-element">
                                    <div>
                                        <span class="vertical-timeline-element-icon bounce-in"></span>
                                        <div class="vertical-timeline-element-content bounce-in">
                                            <h4 class="timeline-title">This dot has an info state</h4>
                                            <span class="vertical-timeline-element-date"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="vertical-timeline-item dot-dark vertical-timeline-element">
                                    <div>
                                        <span class="vertical-timeline-element-icon is-hidden"></span>
                                        <div class="vertical-timeline-element-content is-hidden">
                                            <h4 class="timeline-title">This dot has a dark state</h4>
                                            <span class="vertical-timeline-element-date"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="app-drawer-overlay d-none animated fadeIn"></div>
        {{-- <script type="text/javascript" src="../acccph/vendors/jquery/dist/jquery.min.js"></script>
        <script type="text/javascript" src="../acccph/vendors/slick-carousel/slick/slick.min.js"></script>
        <script type="text/javascript" src="../acccph/js/carousel-slider.js"></script> --}}
        <!-- plugin dependencies -->
        <script type="text/javascript" src="{{ asset('acccph/vendors/jquery/dist/jquery.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('acccph/vendors/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('acccph/vendors/moment/moment.js') }}"></script>
        <script type="text/javascript" src="{{ asset('acccph/vendors/metismenu/dist/metisMenu.js') }}"></script>
        <script type="text/javascript" src="{{ asset('acccph/vendors/bootstrap4-toggle/js/bootstrap4-toggle.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('acccph/vendors/jquery-circle-progress/dist/circle-progress.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('acccph/vendors/perfect-scrollbar/dist/perfect-scrollbar.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('acccph/vendors/toastr/build/toastr.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('acccph/vendors/jquery.fancytree/dist/jquery.fancytree-all-deps.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('acccph/vendors/apexcharts/dist/apexcharts.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('acccph/vendors/bootstrap-table/dist/bootstrap-table.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('acccph/vendors/datatables.net/js/jquery.dataTables.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('acccph/vendors/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('acccph/vendors/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('acccph/vendors/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('acccph/vendors/slick-carousel/slick/slick.min.js') }}"></script>
        <!-- custome.js -->
        {{-- <script type="text/javascript" src="{{ asset('acccph/js/charts/apex-charts.js') }}"></script> --}}
        <script type="text/javascript" src="{{ asset('acccph/js/circle-progress.js') }}"></script>
        <script type="text/javascript" src="{{ asset('acccph/js/demo.js') }}"></script>
        <script type="text/javascript" src="{{ asset('acccph/js/scrollbar.js') }}"></script>
        <script type="text/javascript" src="{{ asset('acccph/js/toastr.js') }}"></script>
        <script type="text/javascript" src="{{ asset('acccph/js/treeview.js') }}"></script>
        <script type="text/javascript" src="{{ asset('acccph/js/form-components/toggle-switch.js') }}"></script>
        <script type="text/javascript" src="{{ asset('acccph/js/tables.js') }}"></script>
        <script type="text/javascript" src="{{ asset('acccph/js/carousel-slider.js') }}"></script>
        <script type="text/javascript" src="{{ asset('acccph/js/app.js') }}"></script> 
        <script src="{{ asset('js/select2.min.js') }}"></script>       
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        @yield('footer')

        <script type="text/javascript">
        
            $(document).ready(function() { 
                $('#building_decline_id').select2({
                    placeholder: "อัตราเสื่อม",
                    allowClear: true
                });
                $('#building_buy_id').select2({
                    placeholder: "วิธีการซื้อ",
                    allowClear: true
                });
                $('#building_method_id').select2({
                    placeholder: "วิธีได้มา",
                    allowClear: true
                });
                $('#building_budget_id').select2({
                    placeholder: "งบประมาณ",
                    allowClear: true
                });
                $('#building_tonnage_number').select2({
                    placeholder: "หมายเลขระวาง",
                    allowClear: true
                });
                $('#land_province_location').select2({
                    placeholder: "จังหวัด",
                    allowClear: true
                });
                $('#land_district_location').select2({
                    placeholder: "อำเภอ",
                    allowClear: true
                });
                $('#land_tumbon_location').select2({
                    placeholder: "ตำบล",
                    allowClear: true
                });
    
                $('#article_deb_subsub_id').select2({
                    placeholder: "ประจำหน่วยงาน",
                    allowClear: true
                });
                $('#article_categoryid').select2({
                    placeholder: "หมวดวัสดุ",
                    allowClear: true
                });
                $('#leave_year_id').select2({
                    placeholder: "ปีงบประมาณ",
                    allowClear: true
                });
                $('#article_decline_id').select2({
                    placeholder: "ประเภทค่าเสื่อม",
                    allowClear: true
                });
                $('#product_typeid').select2({
                    placeholder: "ประเภทวัสดุ",
                    allowClear: true
                });
                $('#product_categoryid').select2({
                    placeholder: "หมวดวัสดุ",
                    allowClear: true
                });
                $('#product_spypriceid').select2({
                    placeholder: "ราคาสืบ",
                    allowClear: true
                });
                $('#product_groupid').select2({
                    placeholder: "ชนิดวัสดุ",
                    allowClear: true
                });
                $('#product_unit_bigid').select2({
                    placeholder: "หน่วยบรรจุ",
                    allowClear: true
                });
                $('#product_unit_subid').select2({
                    placeholder: "หน่วยย่อย",
                    allowClear: true
                });
                $('#status').select2({
                    placeholder: "สถานะ",
                    allowClear: true
                });
                $('#warehouse_rep_user_id').select2({
                    placeholder: "-เลือก-",
                    allowClear: true
                });
                $('#warehouse_rep_inven_id').select2({
                    placeholder: "-เลือก-",
                    allowClear: true
                });
                $('#warehouse_rep_vendor_id').select2({
                    placeholder: "-เลือก-",
                    allowClear: true
                });
                $('#warehouse_rep_year').select2({
                    placeholder: "-เลือก-",
                    allowClear: true
                });
            });
    
            
    
            $(document).ready(function() {
                $('#insert_productForm').on('submit', function(e) {
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
                                    // cancelButtonColor: '#d33',
                                    confirmButtonText: 'เรียบร้อย'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location =
                                            "{{ url('supplies/supplies_index') }}"; // กรณี add page new 
                                    }
                                })
                            }
                        }
                    });
                });
    
                $('#update_productForm').on('submit', function(e) {
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
                                    title: 'แก้ไขข้อมูลสำเร็จ',
                                    text: "You edit data success",
                                    icon: 'success',
                                    showCancelButton: false,
                                    confirmButtonColor: '#06D177',
                                    // cancelButtonColor: '#d33',
                                    confirmButtonText: 'เรียบร้อย'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location =
                                            "{{ url('supplies/supplies_index') }}"; // กรณี add page new   
                                    }
                                })
                            }
                        }
                    });
                });
    
    
            });
    
            $(document).ready(function() {
                $('#insert_serveForm').on('submit', function(e) {
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
                                    // cancelButtonColor: '#d33',
                                    confirmButtonText: 'เรียบร้อย'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location = "{{ url('serve/serve_index') }}";
                                    }
                                })
                            }
                        }
                    });
                });
    
                $('#update_serveForm').on('submit', function(e) {
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
                                    title: 'แก้ไขข้อมูลสำเร็จ',
                                    text: "You edit data success",
                                    icon: 'success',
                                    showCancelButton: false,
                                    confirmButtonColor: '#06D177',
                                    // cancelButtonColor: '#d33',
                                    confirmButtonText: 'เรียบร้อย'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location = "{{ url('serve/serve_index') }}";
                                    }
                                })
                            }
                        }
                    });
                });
    
    
            });
    
            function addproducts(input) {
                var fileInput = document.getElementById('img');
                var url = input.value;
                var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
                if (input.files && input.files[0] && (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg")) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#add_upload_preview').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                } else {
                    alert('กรุณาอัพโหลดไฟล์ประเภทรูปภาพ .jpeg/.jpg/.png/.gif .');
                    fileInput.value = '';
                    return false;
                }
            }
    
            function editproducts(input) {
                var fileInput = document.getElementById('img');
                var url = input.value;
                var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
                if (input.files && input.files[0] && (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg")) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#edit_upload_preview').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                } else {
                    alert('กรุณาอัพโหลดไฟล์ประเภทรูปภาพ .jpeg/.jpg/.png/.gif .');
                    fileInput.value = '';
                    return false;
                }
            }
    
            function addunit() {
                var unitnew = document.getElementById("UNIT_INSERT").value;
                // alert(unitnew);
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: "{{ url('article/addunit') }}",
                    method: "GET",
                    data: {
                        unitnew: unitnew,
                        _token: _token
                    },
                    success: function(result) {
                        $('.show_unit').html(result);
                    }
                })
            }
    
            function addunitsub() {
                var unitnew = document.getElementById("UNIT_SUBINSERT").value;
                // alert(unitnew);
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: "{{ url('article/addunit') }}",
                    method: "GET",
                    data: {
                        unitnew: unitnew,
                        _token: _token
                    },
                    success: function(result) {
                        $('.show_unitsub').html(result);
                    }
                })
            }
    
            function addserve(input) {
                var fileInput = document.getElementById('img');
                var url = input.value;
                var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
                if (input.files && input.files[0] && (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg")) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#add_upload_preview').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                } else {
                    alert('กรุณาอัพโหลดไฟล์ประเภทรูปภาพ .jpeg/.jpg/.png/.gif .');
                    fileInput.value = '';
                    return false;
                }
            }
    
            function editserve(input) {
                var fileInput = document.getElementById('img');
                var url = input.value;
                var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
                if (input.files && input.files[0] && (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg")) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#edit_upload_preview').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                } else {
                    alert('กรุณาอัพโหลดไฟล์ประเภทรูปภาพ .jpeg/.jpg/.png/.gif .');
                    fileInput.value = '';
                    return false;
                }
            }
        </script>

    </body>
</html>
