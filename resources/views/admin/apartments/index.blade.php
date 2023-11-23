@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1 class="mb-4">Apartments - {{ $user->first_name }}</h1>
        <div class=" text-rigth">
            <a href="{{ route('admin.apartments.create') }}" class="btn col-4 btn-primary">INSERISCI</a>
        </div>
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
                                <a href="{{ route('admin.apartments.edit', $apartment) }}"
                                    class="btn col-4 btn-primary">EDIT</a>

                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#delete-apartment-modal-{{ $apartment->id }}">
                                    DELETE
                                </button>

                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>

    </div>
@endsection

{{-- ! FORM + MODAL PER CANCELLARE --}}

@section('modals')
    @foreach ($apartments as $apartment)
        <div class="modal fade" id="delete-apartment-modal-{{ $apartment->id }}" tabindex="-1"
            aria-labelledby="delete-apartment-modal-{{ $apartment->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Confirm
                        </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Do you want to delete apartment "{{ $apartment->title }}"?
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
    @endforeach
@endsection

{{-- ! --}}
