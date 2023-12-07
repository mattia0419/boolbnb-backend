@extends('layouts.app')

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
        </div>
    </div>
@endsection
