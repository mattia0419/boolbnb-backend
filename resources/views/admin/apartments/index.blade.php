@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1 class="mb-4">Apartments - {{ $user->first_name }}</h1>
        <div class="row row-cols-lg-4 row-cols-1 g-4 ">

            @foreach ($apartments as $apartment)
                <div class="col">
                    <div class="card h-100 text-center">
                        <div class="card-image">
                            <img src="{{ $apartment->cover_img }}" class="img-fluid" alt="...">
                        </div>
                        <div class="card-header">
                            <h5 class="card-title">
                                {{ $apartment->title }}
                            </h5>
                        </div>
                        <div class="card-body pb-0 text-start">
                            <p>
                                @if ($apartment->address)
                                    {{ $apartment->address }}
                                @else
                                    -
                                @endif
                            </p>
                            <p>
                                @if ($apartment->square_meters)
                                    {{ $apartment->square_meters }}
                                @else
                                    -
                                @endif
                            </p>
                            <p>
                                @if ($apartment->price)
                                    {{ $apartment->price }}
                                @else
                                    -
                                @endif
                            </p>
                        </div>
                        <div class="card-footer">
                            <a href="#" class="btn col-4 btn-primary">EDIT</a>
                            <a href="#" class="btn col-4 btn-primary">DETAILS</a>

                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
@endsection
