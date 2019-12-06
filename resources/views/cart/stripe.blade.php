@extends('layouts.frontend.master')

@section('title','Cart')
@section('css')
    <style>
        /**
 * The CSS shown here will not be introduced in the Quickstart guide, but shows
 * how you can use CSS to style your Element's container.
 */
        .StripeElement {
            box-sizing: border-box;
            height: 40px;
            padding: 10px 12px;
            border: 1px solid transparent;
            border-radius: 4px;
            background-color: white;
            width: 100%;
            box-shadow: 0 1px 3px 0 #e6ebf1;
            -webkit-transition: box-shadow 150ms ease;
            transition: box-shadow 150ms ease;
        }
        .StripeElement--focus {
            box-shadow: 0 1px 3px 0 #cfd7df;
        }
        .StripeElement--invalid {
            border-color: #fa755a;
        }
        .StripeElement--webkit-autofill {
            background-color: #fefde5 !important;
        }
    </style>
@stop

@section('cover')
    <div class="context">
        <h1 class="font-weight-bold">Checkout</h1>
    </div>
@stop

@section('content')
    <div class="container">
        <div class="py-5 text-center">
            <h2>Checkout form</h2>
        </div>

        <div class="row">

            <div class="col-md-8 order-md-1">
                <h4 class="mb-3">Billing address</h4>
                <form class="needs-validation" action="{{ route('cart.stripe') }}" method="post" id="payment-form">
                    @csrf
                    <h4 class="mb-3">Payment</h4>


                    <script src="https://js.stripe.com/v3/"></script>
                    <div id="show">
                        <div class="form-row">
                            <label for="card-element">
                                Credit or debit card
                            </label>
                            <div id="card-element">
                                <!-- A Stripe Element will be inserted here. -->
                            </div>
                            <!-- Used to display form errors. -->
                            <div id="card-errors" role="alert"></div>
                        </div>
                    </div>
                    <button class="button btn btn-info btn-block my-3">Proceed to checkout</button>
                </form>
                <hr class="mb-4">
            </div>
        </div>
    </div>

@stop


@section('js')
    {{--    <script>--}}
    {{--        $(document).ready(function () {--}}
    {{--            $('#cash').click(function () {--}}
    {{--                $('#show').css('display','none');--}}
    {{--            });--}}
    {{--            $('#online').click(function () {--}}
    {{--                $('#show').css('display','block');--}}
    {{--            });--}}
    {{--        })--}}
    {{--    </script>--}}


    <script>
        // Create a Stripe client.
        var stripe = Stripe('pk_test_7xTD43NsY6O2yiw1cMSskb6000bIITdtPx');
        // Create an instance of Elements.
        var elements = stripe.elements();
        var style = {
            base: {
                color: '#32325d',
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
        // Create an instance of the card Element.
        var card = elements.create('card', {style: style});
        // Add an instance of the card Element into the `card-element` <div>.
        card.mount('#card-element');
        // Handle real-time validation errors from the card Element.
        card.addEventListener('change', function (event) {
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
            stripe.createToken(card).then(function (result) {
                if (result.error) {
                    // Inform the user if there was an error.
                    var errorElement = document.getElementById('card-errors');
                    errorElement.textContent = result.error.message;
                } else {
                    // Send the token to your server.
                    stripeTokenHandler(result.token);
                }
            });
        });
        // Submit the form with the token ID.
        function stripeTokenHandler(token) {
            // Insert the token ID into the form so it gets submitted to the server
            var form = document.getElementById('payment-form');
            var hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'stripeToken');
            hiddenInput.setAttribute('value', token.id);
            form.appendChild(hiddenInput);
            // Submit the form
            form.submit();
        }
    </script>
@stop