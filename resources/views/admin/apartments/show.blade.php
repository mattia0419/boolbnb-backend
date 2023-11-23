@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="my-3 text-end">

            <a class="btn btn-outline-primary" href="{{ route('admin.apartments.index') }}">
                <i class="fa-solid fa-arrow-left me-2"></i>GO BACK
            </a>
            <a class="btn mx-2 btn-outline-success" href="{{ route('admin.apartments.edit', $apartment) }}">
                <i class="fa-solid fa-pen me-2"></i>EDIT
            </a>

            <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal"
                data-bs-target="#delete-apartment-modal-{{ $apartment->id }}">
                <i class="fa-regular fa-trash-can me-2"></i>
                DELATE
            </button>

        </div>
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

{{-- ! FORM + MODAL PER CANCELLARE --}}

@section('modals')
    <div class="modal fade" id="delete-apartment-modal-{{ $apartment->id }}" tabindex="-1"
        aria-labelledby="delete-apartment-modal-{{ $apartment->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Confirm deletion
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you want to delete apartment "{{ $apartment->title }}"?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                    <form action="{{ route('admin.apartments.destroy', $apartment) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button class="btn btn-danger">Delete</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection

{{-- ! --}}
