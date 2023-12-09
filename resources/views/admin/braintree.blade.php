@extends('layouts.app')

@section('cdn')
    <script src="https://js.braintreegateway.com/web/dropin/1.24.0/js/dropin.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
@endsection

@section('content')
    <div class="py-12">
        @csrf
        <div id="dropin-container" style="display: flex;justify-content: center;align-items: center;"></div>
        <input type="radio" value='2.99' name="price" checked>
        <input type="radio" value='5.99' name="price">
        <input type="radio" value='9.99' name="price">
        <div style="display: flex;justify-content: center;align-items: center; color: white">
            <a id="submit-button" class="btn btn-sm btn-success">Submit payment</a>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        let button = document.querySelector('#submit-button');

        braintree.dropin.create({
            authorization: 'sandbox_zjtkt98n_y45kspkr479qbqqv',
            container: '#dropin-container'
        }, function(createErr, instance) {
            button.addEventListener('click', function() {
                instance.requestPaymentMethod(function(err, payload) {
                    button.addEventListener('click', function() {
                        instance.requestPaymentMethod(function(err, payload) {
                            (function($) {
                                $(function() {
                                    $.ajaxSetup({
                                        headers: {
                                            'X-CSRF-TOKEN': $(
                                                'meta[name="csrf-token"]'
                                            ).attr(
                                                'content')
                                        }
                                    });
                                    // var test = $('#test').val();
                                    let price = $(
                                        'input[name="price"]:checked'
                                    ).val();

                                    $.ajax({
                                        type: "POST",
                                        url: "{{ route('admin.token') }}",
                                        data: {
                                            nonce: payload
                                                .nonce,
                                            price: price
                                        },
                                        success: function(
                                            data) {

                                            console.log(
                                                'success',
                                                price,
                                                payload
                                                .nonce)
                                        },
                                        error: function(data) {
                                            console.log(
                                                'error',
                                                price,
                                                payload
                                                .nonce)
                                        }
                                    });
                                });
                            })(jQuery);
                        });
                    });
                });
            });
        });
    </script>
@endsection
