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
    </head>

    <body class="bg-white">
        @if(Auth::check())
        <div class="header">
            <div class="container">
                <div class="row mt-4 mb-3">
                    <div class="col-md-4">
                        <h3 class="text-primary">Private Job Recruitment Cell</h3>
                    </div>
                    <div class="col-md-4">
                        <ul class="list-unstyled list-inline font-16">
                            <li class="list-inline-item"><a href="{{ URL::to('my_account') }}">My Account</a></li>
                            <li class="list-inline-item pl-5"><a href="{{ URL::to('jobs') }}">Jobs</a></li>
                            <li class="list-inline-item pl-5"><a href="{{ URL::to('admission') }}">Admission</a></li>
                        </ul>
                    </div>
                    <div class="col-md-4 text-right">
                        <a href="{{ URL::to('admin/logout/0') }}"><i class="fas fa-power-off mr-2"></i>Logout</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="container mt-4">
            @yield('content')
        </div>
        @else  
        <div class="container">
            @yield('content')      
        </div>
        @endif

        @if(Auth::check())
        <div class="footer text-center position-relative">
            Copyright &copy; 2020 IIET Solutions. All Rights Reserved. 
        </div>
        @endif
        <!---------------------- SUCCESS MESSAGE ------------------>
        <div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body text-center">
                        <img src="{{ asset('images/success_icon.jpg') }}">
                        <p class="msg mt-4"></p>
                        @if (session('success'))
                        <p class="mt-4">{{ session('success') }}</p>
                        @endif
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
                        @if (session('errors'))
                        <ul class="list-unstyled mt-4">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        @endif
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
                        <h5 class="modal-title" id="confirmationModalLabel">Please Confirm</h5>
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


        <script src="{{ asset('assets/vendor/jquery/jquery-3.3.1.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.js') }}"></script>
        <script src="{{ asset('assets/common.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/jquery.dataTables.min.js') }}"></script>
        <script>
@if (session('success'))
$("#successModal").modal();
@endif
        @if (session('errors'))
$("#errorModal").modal();
        @endif
        </script>
        @yield('scripts')
    </body>

</html>