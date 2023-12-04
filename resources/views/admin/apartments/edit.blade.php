@extends('layouts.app')

@section('cdn')
    {{-- tom tom searchbox cdn --}}
    <link rel="stylesheet" type="text/css"
        href="https://api.tomtom.com/maps-sdk-for-web/cdn/plugins/SearchBox/3.1.3-public-preview.0/SearchBox.css" />
    <script src="https://api.tomtom.com/maps-sdk-for-web/cdn/plugins/SearchBox/3.1.3-public-preview.0/SearchBox-web.js">
    </script>
    <script src="https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.1.2-public-preview.15/services/services-web.min.js">
    </script>
@endsection

@section('content')
    <div class="container">
        <h1 class="my-3">Editing apartment: {{ $apartment->title }}</h1>
        <h6 class="mb-4" style="font-style: italic">Fields with * are required</h6>

        <form action="{{ route('admin.apartments.update', $apartment) }}" method="POST" class="row g-3" id="edit-form"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="col-12">
                <label for="title">
                    Title *
                </label>
                <input type="text" name="title" id="title"
                    class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $apartment->title) }}">
                    <span class="text-danger" id="title_error"></span>
                @error('title')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="col-12">
                <label for="rooms">
                    Rooms *
                </label>
                <input type="number" name="rooms" id="rooms" max="999" min="1"
                    class="form-control @error('rooms') is-invalid @enderror" value="{{ old('rooms', $apartment->rooms) }}">
                    <span class="text-danger" id="rooms_error"></span>
                @error('rooms')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="col-12">
                <label for="beds">
                    Beds *
                </label>
                <input type="number" name="beds" id="beds" max="999" min="0"
                    class="form-control @error('beds') is-invalid @enderror" value="{{ old('beds', $apartment->beds) }}">
                    <span class="text-danger" id="beds_error"></span>

                @error('beds')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="col-12">
                <label for="bathrooms">
                    Bathrooms *
                </label>
                <input type="number" name="bathrooms" id="bathrooms" max="999" min="1"
                    class="form-control @error('bathrooms') is-invalid @enderror"
                    value="{{ old('bathrooms', $apartment->bathrooms) }}">
                    <span class="text-danger" id="bathrooms_error"></span>

                @error('bathrooms')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="col-12">
                <label for="square_meters">
                    Square Meters *
                </label>
                <input type="number" name="square_meters" id="square_meters"
                    class="form-control @error('square_meters') is-invalid @enderror"
                    value="{{ old('square_meters', $apartment->square_meters) }}">
                    <span class="text-danger" id="square_meters_error"></span>

                @error('square_meters')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="col-12" id="address-div">
                <label for="address">
                    Address *
                </label>
                {{-- <input type="text" name="address" id="address"
                    class="form-control @error('address') is-invalid @enderror"
                    value="{{ old('address', $apartment->address) }}"> --}}
                @error('address')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <span class="text-danger mt-0" id="address_error"></span>
            <div class="col-12">
                <label for="price">
                    Price *
                </label>
                <input type="number" name="price" id="price"
                    class="form-control @error('price') is-invalid @enderror" value="{{ old('price', $apartment->price) }}"
                    step="0.01">
                    <span class="text-danger" id="price_error"></span>

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
                                value="{{ $service->id }}"
                                class="form-check-control @error('services') is-invalid @enderror"
                                @if (in_array($service->id, old('services') ?? $service_ids)) checked @endif>
                            <label for="service-{{ $service->id }}">{{ $service->label }}</label>
                            @error('services')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    @endforeach
                </div>
                <span class="text-danger" id="services_error"></span>

            </div>
            <div class="col-6">
                <label for="cover_img">
                    Cover image
                </label>
                <input type="file" name="cover_img" id="cover_img"
                    class="form-control @error('cover_img') is-invalid @enderror" value="{{ old('cover_img') }}">
                @error('cover_img')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="col-6">
                <img src="{{ asset('/storage/' . $apartment->cover_img) }}" alt="" class="img-fluid"
                    id="cover_image_preview">
            </div>
            <div class="col-12">
                <label for="visible">
                    Visible *
                </label>
                <select name="visible" id="visible" class="form-select w-25">
                    <option value="0" {{old('visible', $apartment->visible) == 0 ? 'selected' : ''}}>No</option>
                    <option value="1" {{old('visible', $apartment->visible) == 1 ? 'selected' : ''}}>Yes</option>
                </select>
            </div>
            <div class="col-4">
                <div class="btn btn-primary" onclick="validate()">Save</div>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        // preview img
        const inputFileElement = document.getElementById('cover_img');
        const coverImagePreview = document.getElementById('cover_image_preview');
        inputFileElement.addEventListener('change', function() {
            const [file] = this.files;
            coverImagePreview.src = URL.createObjectURL(file);
        })

        // tom tom searchbox
        let options = {
            searchOptions: {
                key: "EoW1gArKxlBBEKl68AZm1uhfhcLougV4",
                language: "en-GB",
                limit: 5,
                countrySet: "IT",
            },
            autocompleteOptions: {
                key: "EoW1gArKxlBBEKl68AZm1uhfhcLougV4",
                language: "en-GB",

            },
        }

        let ttSearchBox = new tt.plugins.SearchBox(tt.services, options);
        let searchBoxHTML = ttSearchBox.getSearchBoxHTML()

        const addressDiv = document.getElementById('address-div')
        addressDiv.appendChild(searchBoxHTML)

        const searchboxInput = document.getElementsByTagName("input")[8];

        searchboxInput.setAttribute('id', 'address');
        searchboxInput.setAttribute('name', 'address');
        searchboxInput.setAttribute('value', '{{ old('address', $apartment->address) }}');
        searchboxInput.setAttribute('class',
            'form-control @error('address') is-invalid @enderror'
            );

            // client-side validation
        function validate() {
            let editForm = document.getElementById('edit-form');

            let title = document.getElementById('title').value;
            let rooms = document.getElementById('rooms').value;
            let beds = document.getElementById('beds').value;
            let bathrooms = document.getElementById('bathrooms').value;
            let squareMeters = document.getElementById('square_meters').value;
            let address = document.getElementById('address').value;
            let price = document.getElementById('price').value;
            let servicesArray = document.getElementsByName('services[]')
            let checkedArray = [];
            
            for(let i = 0; i < servicesArray.length; i++) {
                if(servicesArray[i].checked == true) {
                    checkedArray.push(servicesArray[i])
                }
            }
            
            let titleError = document.getElementById('title_error');
            let roomsError = document.getElementById('rooms_error');
            let bedsError = document.getElementById('beds_error');
            let bathroomsError = document.getElementById('bathrooms_error');
            let squareMetersError = document.getElementById('square_meters_error');
            let addressError = document.getElementById('address_error');
            let priceError = document.getElementById('price_error');
            let servicesError = document.getElementById('services_error');


            titleError.innerHTML = "";
            roomsError.innerHTML = "";
            bedsError.innerHTML = "";
            bathroomsError.innerHTML = "";
            squareMetersError.innerHTML = "";
            addressError.innerHTML = "";
            priceError.innerHTML = "";
            servicesError.innerHTML = "";

            if (title.length <= 0 || rooms <= 0 || beds <= 0 || bathrooms <= 0 || squareMeters <= 0 || address.length <= 3 || price <= 0 || checkedArray.length <= 0) {

                if(title.length <= 0) {
                    titleError.innerHTML = "You need to enter a title";
                    // let titleInput = document.getElementById('title')
                    // titleInput.classList.toggle('is-invalid') 
                }
                // else {
                //     let titleInput = document.getElementById('title')
                //     titleInput.classList.toggle('is-invalid')
                // }

                if(rooms.length <= 0) {
                    roomsError.innerHTML = "You need to enter at least 1 room";
                }

                if(beds.length <= 0) {
                    bedsError.innerHTML = "You need to enter at least 1 bed";
                }

                if(bathrooms.length <= 0) {
                    bathroomsError.innerHTML = "You need to enter at least 1 bathroom";
                }

                if(squareMeters.length <= 0) {
                    squareMetersError.innerHTML = "The apartment is too small";
                }

                if(address.length <= 3) {
                    addressError.innerHTML = "You need to enter an address";
                }

                if(price.length <= 0) {
                    priceError.innerHTML = "You need to enter a price";
                }

                if(checkedArray.length <= 0){ 
                    servicesError.innerHTML = "You need to have at least 1 service";
                }
                
                return false;
            } else {
                editForm.submit();
            }
            
        }
    </script>
@endsection
