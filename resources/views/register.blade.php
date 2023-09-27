@extends('layout')

@section('title', 'Private Job Recruitment Cell - Registration')

@section('content')

<div class="container">
    <div class="row" style="margin-top: 2%;">
        <div class="col-sm-5 offset-sm-4 login_container">
            <div class="text-center">
                <h2 class="text-primary">Private Job Recruitment Cell</h2>
<!--                    <img src="{{ asset('assets/images/contact_logo.jpg') }}" />-->
                <hr>
                <h4><b>Sign Up</b></h4>
            </div>
            <form class="needs-validation" action="/register" method="post" novalidate oninput='confirm_password.setCustomValidity(confirm_password.value != password.value ? "Passwords do not match." : "")'>
                @csrf
                @if (session('success'))
                <div id="login_error_msg" class="col-sm-12 alert alert-success">
                    <p>{{ session('success') }}</p>
                </div>
                @endif
                @if (session('errors'))
                <div id="login_error_msg" class="col-sm-12 alert alert-danger">
                    <ul class="list-unstyled">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <div class="form-group"> 
                    <label>Firstname</label>
                    <input class="form-control" type="text" name="firstname" required>
                </div>
                <div class="form-group"> 
                    <label>Lastname</label>
                    <input class="form-control" type="text" name="lastname" required>
                </div>
                <div class="form-group"> 
                    <label>Phone</label>
                    <input class="form-control" type="text" name="phone" required>
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
                    <label>Confirm Password</label>
                    <input id="confirm_password" class="form-control" type="password" name="confirm_password" required>
                </div>
                <div class="form-group"> 
                    <input type="submit" name="submit" class="btn btn-danger" value="Register">
                </div>
                <div class="form-group"> 
                    <p>Already a member ? <b><a href="{{ URL::to('/') }}">Login</a></b></p>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
