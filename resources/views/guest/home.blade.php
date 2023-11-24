@extends('layouts.app')

@section('content')
    <section class="container mt-5">
        <h1>{{ $title }}</h1>

        <div class="row row-cols-lg-4 row-cols-1 g-4 ">

            @foreach ($apartments as $apartment)
                <div class="col">
                    {{-- <a href="{{ route('admin.apartments.show', $apartment) }}" class=" text-decoration-none text-dark"> --}}
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


                        </div>
                    </div>
                    {{-- </a> --}}
                </div>
            @endforeach
        </div>

    </section>
@endsection
