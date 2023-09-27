@extends('layout')

@section('title', 'Private Job Recruitment Cell - Payment')

@section('content')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<div class="container" style="min-height: 550px;">
    <div class="row mt-5" id="payment_details">
        <div class="col-sm-6 offset-sm-3">

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
            <p class="text-center">Thank you for registering into Private Job Recruitment Cell. <br>Please make payment by using the below payment modes to complete the signup process. 
                Your signup process will complete once Private Job Recruitment Cell confirms the payment.</p>
            <div class="row mt-5 alert alert-danger p-3">
                <div class="col-md-5">
                    <img src="{{ asset('images/gpay.png') }}" style="width: 93px;">
                </div>
                <div class="col-md-7 pt-2" style="font-size: 14px;"><b>9805902345@ybl</b></div>
            </div>
            <div class="row mt-3 alert alert-info p-4">
                <div class="col-md-5">
                    <img src="{{ asset('images/phonepay.png') }}" style="width: 115px;">
                </div>
                <div class="col-md-7 pt-2" style="font-size: 14px;"><b>9805902345@ybl</b></div>
            </div>
            <div class="form-group mt-5 text-center"> 
                <a class="btn btn-success" href="javascript:;" id="proceedBtn">Proceed</a>
                <a class="btn btn-danger" href="javascript:;" id="skipBtn">Skip</a>
            </div>
            <div class="container" style="margin-top:10%;margin-bottom:10%">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="">
                            <p>You will be charged Rs. {{ $_ENV["STRIPE_AMOUNT"] }}</p>
                        </div>
                        <div class="card">
                            <form action="/payment_confirmation"  method="post" id="payment-form">
                                @csrf                    
                                <div class="form-group">
                                    <div class="card-header">
                                        <label for="card-element">
                                            Enter your credit card information
                                        </label>
                                    </div>
                                    <div class="card-body">
                                        <div id="card-element">
                                            <!-- A Stripe Element will be inserted here. -->
                                        </div>
                                        <!-- Used to display form errors. -->
                                        <div id="card-errors" role="alert"></div>
                                        <input type="hidden" name="plan" value="" />
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button
                                        id="card-button"
                                        class="btn btn-dark"
                                        type="submit"
                                        data-secret="{{$intent}}"
                                        > Pay </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="proceed_msg" class="mt-5 d-none">
        <div class="alert alert-info p-5">
            Thanks for updating the  data & payment. Once the payment is confirmed, we will let you know & you will start getting job alerts. 
        </div>

        <div class="form-group text-center">
            <a class="btn btn-success" href="{{ URL::to('/my_account') }}">Back to My Account</a>
            <a class="btn btn-danger" href="{{ URL::to('/payment') }}">Make Payment</a>
        </div>
    </div>
    <div id="skip_msg" class="mt-5 d-none">
        <div class="alert alert-danger p-5 text-center">
            You will not receive  any job alerts. <br><br>

            You have skipped the  payment step, we highly suggest you to do payment so that you can get the job alerts.
        </div>

        <div class="form-group text-center">
            <a class="btn btn-success" href="{{ URL::to('/my_account') }}">Back to My Account</a>
            <a class="btn btn-danger" href="{{ URL::to('/payment') }}">Make Payment</a>
        </div>
    </div>
</div>


<script src="https://js.stripe.com/v3/"></script>
<script>
// Custom styling can be passed to options when creating an Element.
// (Note that this demo uses a wider set of styles than the guide below.)

var style = {
    base: {
        color: '#32325d',
        lineHeight: '18px',
        fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
        fontSmoothing: 'antialiased',
        fontSize: '16px',
        '::placeholder': {
            color: '#aab7c4'
        }
    },
    invalid: {
        color: '#fa755a',
        iconColor: '#fa755a'
    }
};

const stripe = Stripe('{{ $stripe_key }}', {locale: 'en'}); // Create a Stripe client.
const elements = stripe.elements(); // Create an instance of Elements.
const cardElement = elements.create('card', {style: style}); // Create an instance of the card Element.
const cardButton = document.getElementById('card-button');
const clientSecret = cardButton.dataset.secret;

cardElement.mount('#card-element'); // Add an instance of the card Element into the `card-element` <div>.

// Handle real-time validation errors from the card Element.
cardElement.addEventListener('change', function (event) {
    var displayError = document.getElementById('card-errors');
    if (event.error) {
        displayError.textContent = event.error.message;
    } else {
        displayError.textContent = '';
    }
});

// Handle form submission.
var form = document.getElementById('payment-form');

form.addEventListener('submit', function (event) {
    event.preventDefault();

    stripe.handleCardPayment(clientSecret, cardElement, {
        payment_method_data: {
            //billing_details: { name: cardHolderName.value }
        }
    })
            .then(function (result) {
                console.log(result);
                if (result.error) {
                    // Inform the user if there was an error.
                    var errorElement = document.getElementById('card-errors');
                    errorElement.textContent = result.error.message;
                } else {
                    console.log(result);
                    form.submit();
                }
            });
});
</script>

@endsection

@section('scripts')
<script type="text/javascript" src="{{ asset('js/payment.js') }}"></script>

@endsection
