@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row g-3">
            <div class="col-12 col-lg-4">

                @if ($apartment->cover_img)
                    <img src="{{ asset('/storage/' . $apartment->cover_img) }}" alt=""
                        class="image-fluid w-100 rounded">
                @else
                    <img src="https://placehold.co/400" alt="" class="image-fluid w-100 rounded">
                @endif
            </div>
            <div class="col-12 col-lg-8 text-center text-lg-start d-flex flex-column justify-content-between">
                <h1>{{ $apartment->title }}</h1>
                <p>
                    <strong>Camere : </strong>
                    @if ($apartment->rooms)
                        {{ $apartment->rooms }}
                    @else
                        -
                    @endif
                </p>
                <p>
                    <strong>Letti : </strong>

                    @if ($apartment->beds)
                        {{ $apartment->beds }}
                    @else
                        -
                    @endif
                </p>
                <p>
                    <strong>Bagni : </strong>

                    @if ($apartment->bathrooms)
                        {{ $apartment->bathrooms }}
                    @else
                        -
                    @endif
                </p>
                <p>
                    <strong>Metri Quadrati : </strong>
                    @if ($apartment->square_meters)
                        {{ $apartment->square_meters }}
                    @else
                        -
                    @endif
                </p>
                <p>
                    <strong>Indirizzo : </strong>
                    @if ($apartment->address)
                        {{ $apartment->address }}
                    @else
                        -
                    @endif
                </p>
                <p class="m-0">
                    <strong>Prezzo Per Notte : </strong>
                    @if ($apartment->price)
                        {{ $apartment->price }} €
                    @else
                        -
                    @endif
                </p>
            </div>
            <div class="col-12">
                <hr>
                <div class="row row-cols-1 row-cols-md-2">
                    @foreach ($apartment->services as $service)
                        <p>
                            {{ $service->label }}
                        </p>
                    @endforeach
                </div>
            </div>
        </div>

    </div>
@endsection
