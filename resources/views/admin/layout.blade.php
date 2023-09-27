<!doctype html>
<html lang="en">

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('title')</title>
        <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/libs/css/style.css') }}" rel="stylesheet">    
        <link href="{{ asset('assets/vendor/fonts/fontawesome/css/fontawesome-all.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/custom.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/jquery.dataTables.min.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/vendor/fonts/material-design-iconic-font/css/materialdesignicons.min.css') }}" rel="stylesheet">
    </head>

    <body>
        <div id="loader" class="d-none"></div>
        @if(Auth::check())
        <!-- ============================================================== -->
        <!-- main wrapper -->
        <!-- ============================================================== -->
        <div class="dashboard-main-wrapper">
            <!-- ============================================================== -->
            <!-- navbar -->
            <!-- ============================================================== -->
            <div class="dashboard-header">
                <nav class="navbar navbar-expand-lg bg-white fixed-top">
                    <a class="navbar-brand" href="index.html">Private Job Recruitment Cell</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse " id="navbarSupportedContent">
                        <ul class="navbar-nav ml-auto navbar-right-top">
                            <li class="nav-item dropdown connection pt-2 pr-3">
                                <i class="fas fa-user-circle" style="font-size: 15px;"></i> Welcome, {{ ucfirst(Auth::user()->name) }}
                            </li>
                            <li class="nav-item dropdown nav-user pr-3 pl-3 pt-2">
                                <a href="{{ URL::to('admin/logout') }}"><i class="fas fa-power-off mr-2"></i>Logout</a>
                            </li>
                        </ul>
                    </div>
                </nav>










                <!--                <a class="navbar-brand" href="index.html">Concept</a>
                                <nav class="navbar navbar-expand-lg bg-white fixed-top">
                                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                        <span class="navbar-toggler-icon"></span>
                                    </button>
                                    <div class="collapse navbar-collapse " id="navbarSupportedContent">
                                        <ul class="navbar-nav ml-auto navbar-right-top">
                                            <li class="nav-item">
                                                <i class="fas fa-user-circle" style="font-size: 15px;"></i> Welcome, {{ ucfirst(Auth::user()->name) }} &nbsp;&nbsp;
                                                <a href="{{ URL::to('logout') }}"><i class="fas fa-power-off mr-2"></i>Logout</a>
                                            </li>
                                        </ul>
                                    </div>
                                </nav>-->
            </div>
            <!-- ============================================================== -->
            <!-- end navbar -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- left sidebar -->
            <!-- ============================================================== -->
            <div class="nav-left-sidebar sidebar-dark">
                <div class="menu-list">
                    <nav class="navbar navbar-expand-lg navbar-light">
                        <a class="d-xl-none d-lg-none" href="#">Dashboard</a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarNav">
                            <ul class="navbar-nav flex-column mt-5">
                                <li class="nav-item ">
                                    <a class="nav-link" href="{{ URL::to('admin/dashboard') }}"><i class="fa fa-fw fa-user-circle"></i>Dashboard</a>
                                </li>
                                <li class="nav-item ">
                                    <a class="nav-link" href="{{ URL::to('admin/jobs') }}" data-toggle="collapse" aria-expanded="false" data-target="#submenu-1-2" aria-controls="submenu-1-2"><i class="fab fa-fw fa-wpforms"></i>Manage Jobs</a>
                                    <div id="submenu-1-2" class="collapse submenu" style="">
                                        <ul class="nav flex-column">
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{ URL::to('admin/jobs') }}">Jobs</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{ URL::to('admin/job_types') }}">Job Types</a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>

                                <li class="nav-item ">
                                    <a class="nav-link" href="{{ URL::to('admin/customers') }}"><i class="fab fa-fw fa-wpforms"></i>Customers</a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- end left sidebar -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <div class="dashboard-wrapper">
                <div class="dashboard-ecommerce">
                    <div class="container-fluid dashboard-content">
                        @yield('content')
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- footer -->
                <!-- ============================================================== -->
                <div class="footer" style="position: absolute !important;">
                    <div class="container">
                        Copyright © 2020. All rights reserved.
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- end footer -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- end wrapper  -->
            <!-- ============================================================== -->

        </div>
        <!-- ============================================================== -->
        <!-- end main wrapper  -->
        <!-- ============================================================== -->
        @else
        @yield('content')
        @endif
        <!---------------------- SUCCESS MESSAGE ------------------>
        <div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body text-center">
                        <img src="{{ asset('images/success_icon.jpg') }}">
                        <p class="msg mt-4"></p>

                        <div class="form-group mt-3 text-center">      
                            <button class="btn btn-default btn-outline-primary btn-sm" data-dismiss="modal" type="button">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!---------------------- ERROR MESSAGE ------------------>
        <div class="modal fade" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body text-center">
                        <img src="{{ asset('images/failure_icon.jpg') }}">
                        <p class="msg mt-4"></p>

                        <div class="form-group mt-3 text-center">      
                            <button class="btn btn-default btn-outline-primary btn-sm" data-dismiss="modal" type="button">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!---------------------- CONFIRMATION DIALOG ------------------>
        <div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header modal-header-error">
                        <h5 class="modal-title" id="confirmationModalLabel">Confirm</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p class="confirmDialogMessage"></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-danger btn-sm" id="confirmOk">Yes</button>
                        <button type="button" class="btn btn-outline-primary btn-sm" id="confirmCancel">No</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Optional JavaScript -->
        <!-- jquery 3.3.1 -->
        <script src="{{ asset('assets/vendor/jquery/jquery-3.3.1.min.js') }}"></script>
        <!-- bootstap bundle js -->
        <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.js') }}"></script>
        <script src="{{ asset('assets/common.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/jquery.dataTables.min.js') }}"></script>

        @yield('scripts')
    </body>

</html>