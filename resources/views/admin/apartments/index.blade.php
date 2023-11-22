@extends('layouts.app')

@section('content')

<div class="container mt-5">
    <h1 class="mb-4">Apartments - {{$user->email}}</h1>
    <div class="row row-cols-4">

        @foreach($apartments as $apartment)
        <div class="col">
            <div class="card">
                <div class="card-header">
                    {{ $apartment->title}}
                </div>
                <div class="card-body"></div>
                <div class="card-footer"></div>
            </div>
        </div>
        @endforeach
    </div>

</div>


@endsection