@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="{{ route('admin.apartments.update', $apartment) }}" method="POST" class="row"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="col-12">
                <label for="title">
                    Title
                </label>
                <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror"
                    value="{{ old('title', $apartment->title) }}">
                @error('title')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="col-12">
                <label for="rooms">
                    Rooms
                </label>
                <input type="number" name="rooms" id="rooms" max="100" min="1"
                    class="form-control @error('rooms') is-invalid @enderror" value="{{ old('rooms', $apartment->rooms) }}">
                @error('rooms')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="col-12">
                <label for="beds">
                    Beds
                </label>
                <input type="number" name="beds" id="beds" max="100" min="0"
                    class="form-control @error('beds') is-invalid @enderror" value="{{ old('beds', $apartment->beds) }}">
                @error('beds')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="col-12">
                <label for="bathrooms">
                    Bathrooms
                </label>
                <input type="number" name="bathrooms" id="bathrooms" max="10" min="1"
                    class="form-control @error('bathrooms') is-invalid @enderror"
                    value="{{ old('bathrooms', $apartment->bathrooms) }}">
                @error('bathrooms')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="col-12">
                <label for="square_meters">
                    Square Meters
                </label>
                <input type="number" name="square_meters" id="square_meters"
                    class="form-control @error('square_meters') is-invalid @enderror"
                    value="{{ old('square_meters', $apartment->square_meters) }}">
                @error('square_meters')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="col-12">
                <label for="address">
                    Address
                </label>
                <input type="text" name="address" id="address"
                    class="form-control @error('address') is-invalid @enderror"
                    value="{{ old('address', $apartment->address) }}">
                @error('address')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="col-12">
                <label for="price">
                    Price
                </label>
                <input type="number" name="price" id="price"
                    class="form-control @error('price') is-invalid @enderror" value="{{ old('price', $apartment->price) }}"
                    step="0.01">
                @error('price')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="col-12">
                @foreach ($services as $service)
                    <div class="col-2">
                        <input type="checkbox" name="services[]" id="service-{{ $service->id }}"
                            value="{{ $service->id }}" class="form-check-control"
                            @if (in_array($service->id, old('services', $service_ids))) checked @endif>
                        <label for="service-{{ $service->id }}">{{ $service->label }}</label>
                    </div>
                @endforeach
            </div>
            @error('services')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
            <div class="col-12">
                <label for="cover_img">
                    Cover image
                </label>
                <input type="file" name="cover_img" id="cover_img"
                    class="form-control @error('cover_img') is-invalid @enderror"
                    value="{{ old('cover_img', $apartment->cover_img) }}">
                @error('cover_img')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="col-12 mx-2">
                <label for="visible">
                    Visibility
                </label>
                <select name="visible" id="visible">
                    <option value="0">no</option>
                    <option value="1">yes</option>
                </select>
            </div>
            <div class="col-4">
                <button class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>
@endsection
