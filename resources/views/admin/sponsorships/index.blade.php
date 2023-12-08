@section('session')
    @php
        session_start();
        if ($_SESSION) {
            session_destroy();
        }
    @endphp
    {{-- @dd($_SESSION) --}}
@endsection

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="my-5">Choose your plan</h1>
        <div class="row">
            {{-- @php
                function saveSession($key)
                {
                    // session_start();

                    $price = $sponsorship[$key]->price;
                    $sponsorship_id = $sponsorship[$key]->id;
                    $apartment_id = array_key_first($apartment);
                    $_SESSION['price'] = $price;
                    $_SESSION['sponsorship_id'] = $sponsorship_id;
                    $_SESSION['apartment_id'] = $apartment_id;
                }
            @endphp --}}
            <div id="prova"></div>
            @foreach ($sponsorships as $sponsorship)
                <div class="col-4">
                    <div class="card text-center">
                        <div class="card-header">
                            <h4>{{ $sponsorship->label }}</h4>
                        </div>
                        <div class="card-body">
                            <p>Your apartment will be sponsored for {{ $sponsorship->duration }}h</p>
                            <p>Price: {{ $sponsorship->price }}€</p>

                            {{-- se funziona la sessione, il pulsante deve mandare ad admin.token ma senza inviare gli input --}}

                            <form action="{{ route('admin.token') }}" method="POST">
                                @csrf

                                <input type="hidden" value='{{ array_key_first($apartment) }}' name="apartment-id">
                                <input type="hidden" value='{{ $sponsorship->id }}' name="sponsor-id">
                                <input type="hidden" value='{{ $sponsorship->label }}' name="sponsor-label">
                                <input type="hidden" value='{{ $sponsorship->price }}' name="sponsor-price">
                                <input type="hidden" value='{{ $sponsorship->duration }}' name="sponsor-duration">
                                <button class="btn mx-2 btn-outline-primary" type="submit"
                                    id="go-to-sponsor-{{ $sponsorship->id }}"
                                    onclick="saveSession({{ $sponsorship->id - 1 }})" key='{{ $sponsorship->id - 1 }}'>
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

@section('scripts')
    <script>
        function saveSession() {
            let prova = document.getElementById('prova');

            prova.innerHTML = `<?php
            // session_start();
            
            $price = $sponsorship->price;
            $sponsorship_id = $sponsorship->id;
            $apartment_id = array_key_first($apartment);
            $_SESSION['price'] = $price;
            $_SESSION['sponsorship_id'] = $sponsorship_id;
            $_SESSION['apartment_id'] = $apartment_id;
            ?>`;
        };
    </script>
@endsection
