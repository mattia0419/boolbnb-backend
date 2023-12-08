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
                            <form action="{{ route('admin.apartments.sponsorize') }}" method="POST">
                                @csrf

                                <input type="hidden" value='{{ array_key_first($apartment) }}' name="apartment-id">
                                <input type="hidden" value='{{ $sponsorship->id }}' name="sponsor-id">
                                <input type="hidden" value='{{ $sponsorship->label }}' name="sponsor-label">
                                <input type="hidden" value='{{ $sponsorship->price }}' name="sponsor-price">
                                <input type="hidden" value='{{ $sponsorship->duration }}' name="sponsor-duration">
                                <button class="btn mx-2 btn-outline-primary" type="submit"
                                    id="go-to-sponsor-{{ $sponsorship->id }}" key='{{ $sponsorship->price }}'>
                                    <strong>SPONSORSHIP</strong>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
