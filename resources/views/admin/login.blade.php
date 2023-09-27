@extends('admin.layout')

@section('title', 'Private Job Recruitment Cell - Login')

@section('content')

<div class="container">
    <div class="row" style="margin-top: 10%;">
        <div class="col-sm-5 offset-sm-4 login_container">
            <div class="text-center">
                <h2 class="text-primary">Private Job Recruitment Cell</h2>
<!--                    <img src="{{ asset('assets/images/contact_logo.jpg') }}" />-->
                <hr>
                <h4><b>Administrator Login</b></h4>
            </div>
            <form class="needs-validation" action="/admin/login" method="post" novalidate>
                @csrf
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <div id="login_error_msg" class="col-sm-12 alert alert-danger"  style="display:none;">
                    <ul></ul>
                </div>
                <div class="form-group"> 
                    <label>Email</label>
                    <input class="form-control" type="email" name="email" required>
                </div>
                <div class="form-group"> 
                    <label>Password</label>
                    <input id="password" class="form-control" type="password" name="password" required>
                </div>
                <div class="form-group"> 
                    <input type="submit" name="submit" class="btn btn-danger" value="Login">
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
