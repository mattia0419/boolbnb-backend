@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Register') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}" name="registration">
                            @csrf

                            <div class="mb-4 row">
                                <h6 class="mb-4" style="font-style: italic">Fields with * are required</h6>

                                <label for="first_name"
                                    class="col-md-4 col-form-label text-md-right">{{ __('First name *') }}</label>

                                <div class="col-md-6">
                                    <input id="first_name" type="text"
                                        class="form-control @error('first_name') is-invalid @enderror" name="first_name"
                                        value="{{ old('first_name') }}" autocomplete="first_name" autofocus>
                                    <span class="text-danger" id="first_name_error"></span>


                                    @error('first_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-4 row">
                                <label for="last_name"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Last name *') }}</label>

                                <div class="col-md-6">
                                    <input id="last_name" type="text"
                                        class="form-control @error('last_name') is-invalid @enderror" name="last_name"
                                        value="{{ old('last_name') }}" autocomplete="last_name" autofocus>
                                    <span class="text-danger" id="last_name_error"></span>


                                    @error('last_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-4 row">
                                <label for="date_of_birth"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Date of birth') }}</label>

                                <div class="col-md-6">
                                    <input id="date_of_birth" type="date"
                                        class="form-control @error('date_of_birth') is-invalid @enderror"
                                        name="date_of_birth" value="{{ old('date_of_birth') }}" autocomplete="date_of_birth"
                                        autofocus>

                                    @error('date_of_birth')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-4 row">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address *') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email">
                                    <span class="text-danger" id="email_error"></span>


                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-4 row">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Password *') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password">
                                    <span class="text-danger" id="password_error"></span>

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-4 row">
                                <label for="password-confirm"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password *') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required autocomplete="new-password">
                                    <span class="text-danger" id="confirmation_error"></span>

                                </div>
                            </div>
                            {{-- <div class="mb-4 row">
                                <label for="profile_img" class="col-md-4 col-form-label text-md-right">Profile image</label>
                                <div class="col-md-6">

                                    <input type="file" name="profile_img" id="profile_img"
                                        class="form-control @error('profile_img') is-invalid @enderror"
                                        value="{{ old('profile_img') }}">
                                    @error('profile_img')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div> --}}

                            <div class="mb-4 row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <div class="btn btn-primary" onclick="validate()">
                                        {{ __('Register') }}
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        function validate() {
            let password = document.getElementById('password').value;
            let confirmation = document.getElementById('password-confirm').value;
            let firstName = document.getElementById('first_name').value;
            let lastName = document.getElementById('last_name').value;
            let email = document.getElementById('email').value;


            let passwordError = document.getElementById('password_error');
            let confirmationError = document.getElementById('confirmation_error');
            let firstNameError = document.getElementById('first_name_error');
            let lastNameError = document.getElementById('last_name_error');
            let emailError = document.getElementById('email_error');

            firstNameError.innerHTML = "";
            lastNameError.innerHTML = "";
            emailError.innerHTML = "";
            passwordError.innerHTML = "";

            if (firstName.length == 0 || lastName.length == 0 || email.length == 0 || password.length == 0 || password !=
                confirmation) {

                if (firstName.length == 0) {
                    firstNameError.innerHTML = "You need to enter a first name";
                }

                if (lastName.length == 0) {
                    lastNameError.innerHTML = "You need to enter a last name";
                }

                if (email.length == 0) {
                    emailError.innerHTML = "You need to enter an email address";
                }

                if (password.length == 0) {
                    passwordError.innerHTML = "You need to enter a password";
                } else if (password.length < 8 && password.length >= 1) {
                    passwordError.innerHTML = "You must enter at least 8 characters";
                }

                if (password != confirmation) {
                    passwordError.innerHTML = "The passwords don't match";
                    confirmationError.innerHTML = "The passwords don't match";
                    document.registration.confirmation.value = "";
                    document.registration.confirmation.focus();
                }

                return false;
            }

            if (password == confirmation) {
                document.registration.submit();
            }
        }
    </script>
@endsection
