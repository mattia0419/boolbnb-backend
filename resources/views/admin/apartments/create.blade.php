@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="my-3">Add apartment</h1>
        <h6 class="mb-4" style="font-style: italic">Fields with * are required</h6>

        <form action="{{ route('admin.apartments.store') }}" method="POST" class="row g-3" enctype="multipart/form-data">
            @csrf
            
            <div class="col-12">
                <label for="title">
                    Title *
                </label>
                <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror"
                    value="{{ old('title') }}">
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
                    class="form-control @error('rooms') is-invalid @enderror" value="{{ old('rooms') }}">
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
                    class="form-control @error('beds') is-invalid @enderror" value="{{ old('beds') }}">
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
                    class="form-control @error('bathrooms') is-invalid @enderror" value="{{ old('bathrooms') }}">
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
                    class="form-control @error('square_meters') is-invalid @enderror" value="{{ old('square_meters') }}">
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
                    class="form-control @error('address') is-invalid @enderror" value="{{ old('address') }}">
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
                    class="form-control @error('price') is-invalid @enderror" value="{{ old('price') }}" step="0.01">
                @error('price')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="col-12">
                <span>
                    Services * <span style="font-style: italic">(at least one)</span>
                </span>
                <div class="col-2 d-flex">
                    @foreach ($services as $service)
                        <div class="col-12">
                        <input type="checkbox" name="services[]" id="service-{{ $service->id }}"
                            value="{{ $service->id }}" class="form-check-control @error('services') is-invalid @enderror"
                            @if (in_array($service->id, old('services') ?? [])) checked @endif>
                            <label for="service-{{ $service->id }}">{{ $service->label }}</label>
                            @error('services')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        @endforeach
                </div>
            </div>
            <div class="col-12">
                <label for="cover_img">
                    Cover image *
                </label>
                <input type="file" name="cover_img" id="cover_img"
                    class="form-control @error('cover_img') is-invalid @enderror" value="{{ old('cover_img') }}">
                @error('cover_img')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="col-12">
                <label for="visible">
                    Visible *
                </label>
                <select name="visible" id="visible" class="form-select w-25">
                    <option value="0">No</option>
                    <option value="1">Yes</option>
                </select>
            </div>
            <div class="col-4">
                <button class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>
@endsection
