@extends('layouts.app')

@section('cdn')
    <script src="https://js.braintreegateway.com/web/dropin/1.24.0/js/dropin.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
@endsection


@section('content')
    <div class="container">
        <div class="my-3 d-flex flex-row justify-content-between align-items-center">
            <h1 class="my-5">Choose your plan</h1>

            <a class="btn btn-outline-primary" href="{{ route('admin.apartments.index') }}">
                <i class="fa-solid fa-arrow-left me-2"></i>GO BACK
            </a>
        </div>
        <div class="row g-3">
            <div id="prova"></div>
            <input type="hidden" value='{{ array_key_first($apartment) }}' id="apartment-id">
            @foreach ($sponsorships as $sponsorship)
                <div class="col-12 col-lg-4">
                    <input class="d-none select" type="radio" id="{{ $sponsorship->id }}"
                        value='{{ $sponsorship->price }}' name="price" checked>
                    <label for="{{ $sponsorship->id }}" class="card text-center">
                        <div class="card-header">
                            <h4>{{ $sponsorship->label }}</h4>
                        </div>
                        <div class="card-body my-5">
                            <p class="fs-5">Your apartment will be sponsored for</p>
                            <p class="fs-1"> <?php echo 24 * $sponsorship->duration; ?> h</p>
                            <p class="fs-5">Price: <span class="fs-3"> {{ $sponsorship->price }} €</span></p>

                        </div>
                    </label>
                </div>
            @endforeach
            <div class="py-5">
                @csrf

                <div id="dropin-container" style="display: flex;justify-content: center;align-items: center;"></div>
                <div style="display: flex;justify-content: center;align-items: center; color: white">
                    <a id="submit-button" class="btn btn-sm btn-success">Confirm CreditCard</a>
                </div>
            </div>
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
                    button.innerHTML = "Submit payment"
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
                                    let apartment_id = $(
                                        '#apartment-id').val();
                                    let price = $(
                                        'input[name="price"]:checked'
                                    ).val();


                                    $.ajax({
                                        type: "POST",
                                        url: "{{ route('admin.token') }}",
                                        data: {
                                            nonce: payload
                                                .nonce,
                                            apartment_id: apartment_id,
                                            price: price
                                        },
                                        success: function(
                                            data) {

                                            console.log(
                                                'success',
                                                price,
                                                apartment_id,
                                                payload
                                                .nonce)
                                            window.location
                                                .href =
                                                "http://localhost:5174/";
                                        },
                                        error: function(data) {
                                            console.log(
                                                'error',
                                                price,
                                                apartment_id,
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
