@extends('layouts.app')

@section('cdn')
    <script src=" 
   https://js.braintreegateway.com/web/dropin/1.40.2/js/dropin.min.js 
   "></script>
@endsection

@section('content')
    <div class="container">
        <h1 class="my-5">Choose your plan</h1>
        <div class="row">
            @foreach ($sponsorships as $sponsorship)
                <div class="col-4">
                    <div class="card text-center">
                        <div class="card-header">
                            <h4>{{ $sponsorship->label }}</h4>
                        </div>
                        <div class="card-body">
                            <p>Your apartment will be sponsored for {{ $sponsorship->duration }}h</p>
                            <p>Price: {{ $sponsorship->price }}€</p>
                            <button class="btn btn-primary w-25"> <strong>GET</strong> </button>
                        </div>
                    </div>
                </div>
            @endforeach
            {{-- pagamenti --}}
            <form id="payment-form" action="/" method="post">
                <div id="dropin-container"></div>
                <input type="submit" value="Purchase"></input>
                <input type="hidden" id="nonce" name="payment_method_nonce"></input>
              </form>
        </div>
    </div>
@endsection

@section('sctipts')
    <script type="text/javascript">
    let form = document.querySelector('#payment-form');
    let nonceInput = document.querySelector('#nonce');

    // gateway (token)
    const braintree = require("braintree");

const gateway = new braintree.BraintreeGateway({
  environment: braintree.Environment.Sandbox,
  merchantId: "y45kspkr479qbqqv",
  publicKey: "q9djjd2vt8zvtbrd",
  privateKey: "4a7efb59e71e7a09cad2470ede9e8174"
});

// CLIENT TOKEN GENERATE
gateway.clientToken.generate({
  customerId: aCustomerId
}).then(response => {
  // pass clientToken to your front-end
  const clientToken = response.clientToken
});

// CALL
app.get("/client_token", (req, res) => {
  gateway.clientToken.generate({}).then(response => {
    res.send(response.clientToken);
  });
});

// CREATE DROP-IN
braintree.dropin.create({
        authorization: 'sandbox_zjtkt98n_y45kspkr479qbqqv',
        container: '#dropin-container'
      }, function (err, dropinInstance) {
        if (err) {
          // Handle any errors that might've occurred when creating Drop-in
          console.error(err);
          return;
        }
        form.addEventListener('submit', function (event) {
          event.preventDefault();

          dropinInstance.requestPaymentMethod(function (err, payload) {
            if (err) {
              // Handle errors in requesting payment method
              return;
            }

            // Send payload.nonce to your server
            nonceInput.value = payload.nonce;
            form.submit();
          });
        });
      });
    </script>
@endsection
