@extends('layout')

@section('title', 'Private Job Recruitment Cell - Payment')

@section('content')
<div id="proceed_msg" class="mt-5">
    <div class="alert alert-info p-5">
        Thanks for updating the  data & payment. Once the payment is confirmed, we will let you know & you will start getting job alerts. 
    </div>

    <div class="form-group text-center">
        <a class="btn btn-success" href="{{ URL::to('/my_account') }}">Back to My Account</a>
    </div>
</div>
@endsection