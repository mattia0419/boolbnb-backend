@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1 class="mb-4">Apartments - {{ $user->first_name }}</h1>
        <h6 class="text-secondary">Clicca sulle card per maggiori informazioni</h6>
        <div class="row row-cols-lg-4 row-cols-1 g-4 ">

            @foreach ($apartments as $apartment)
                <div class="col">
                    <a href="{{ route('admin.apartments.show', $apartment) }}" class=" text-decoration-none text-dark">
                        <div class="card h-100 text-center">
                            <div class="card-image">
                                @if ($apartment->cover_img)
                                    <img src="{{ asset('/storage/' . $apartment->cover_img) }}" alt=""
                                        class="image-fluid w-100">
                                @else
                                    <img src="https://placehold.co/400" alt="" class="image-fluid w-100">
                                @endif
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
                            <div class="card-footer mt-auto">
                                <a href="#" class="btn col-4 btn-primary">EDIT</a>
                                {{-- <a href="{{ route('admin.apartments.show', $apartment) }}"
                                    class="btn col-4 btn-primary">DETAILS</a> --}}

                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>

    </div>
@endsection
