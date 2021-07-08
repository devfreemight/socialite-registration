@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">

                <div class="card-body">

                    <h3 class="text-center font-weight-bold mb-5 mt-3">Sign Up Here</h1>

                    <form class="px-4" method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group">
                            <label for="name" class="font-weight-bold">{{ __('Full Name') }}</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ isset($name) ? $name : old('name') }}" required autocomplete="name" autofocus placeholder="Juan Dela Cruz">

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="gender" class="font-weight-bold">{{ __('Gender') }}</label>
                            <select class="form-control @error('gender') is-invalid @enderror" name="gender" id="gender" required>
                                <option value="">Select Gender</option>
                                <option value="0" {{ old('gender') == '0' ? 'selected' : '' }}>Male</option>
                                <option value="1" {{ old('gender') == '1' ? 'selected' : '' }}>Female</option>
                            </select>

                            @error('gender')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="birthday" class="font-weight-bold">{{ __('Birthday') }}</label>
                            <input id="birthday" type="text" class="form-control @error('birthday') is-invalid @enderror" name="birthday" value="{{ isset($birthday) ? $birthday : old('birthday') }}" required placeholder="mm/dd/YYYY">

                            @error('birthday')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="contact_no" class="font-weight-bold">{{ __('Contact No.') }}</label>
                            <input id="contact_no" type="text" class="form-control @error('contact_no') is-invalid @enderror" name="contact_no" value="{{ old('contact_no') }}" required placeholder="09123456789">

                            @error('contact_no')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="age" class="font-weight-bold">{{ __('Age') }}</label>
                            <input id="age" type="text" class="form-control @error('age') is-invalid @enderror" name="age" value="{{ old('age') }}" required placeholder="18-30">

                            @error('age')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="address" class="font-weight-bold">{{ __('Address') }}</label>
                            <input id="address" type="text" class="form-control @error('street') is-invalid @enderror" name="street" value="{{ old('street') }}" required placeholder="Street">

                            @error('street')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <select class="form-control @error('barangay') is-invalid @enderror" name="barangay" id="barangay" required>
                                <option value="">Barangay</option>
                            </select>

                            @error('barangay')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-control" name="city_name" value="{{ isset($city_name) ? $city_name : old('city_name') }}" disabled>
                        </div>

                        <div class="form-group">
                            <label for="landmark" class="font-weight-bold">{{ __('Landmark') }}</label>
                            <textarea id="landmark" autofocus class="form-control @error('landmark') is-invalid @enderror" rows="3" name="landmark" required>{{ old('landmark') }}</textarea>

                            @error('landmark')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" value="1" id="t&c" name="t&c" required>
                            <label for="t&c" class="form-check-label">
                                I agree to the <ins>Terms of Service</ins> and <ins>Privacy Policy</ins>
                            </label>

                            @error('t&c')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Submit') }}
                            </button>
                        </div>

                        <input type="hidden" name="city_id" value="{{ isset($city_id) ? $city_id : old('city_id') }}">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
