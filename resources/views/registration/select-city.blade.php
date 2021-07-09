@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center select-city">
        <div class="col-md-6">
            <div class="card">
                {{-- <div class="card-header">SELECT CITY</div> --}}
                <div class="card-body">
                    <h3 class="text-center font-weight-bold mb-5 mt-3">Select City</h1>

                    <div class="mb-4">
                        @foreach ($cities as $city)
                            <a class="btn btn-outline-primary btn-lg btn-block" href="{{ route('user.registration', ['city_id' => $city->id]) }}" role="button">{{ $city->name }}</a>
                        @endforeach
                    </div>


                    {{-- <form method="POST" action="{{ route('user.registration') }}">
                        @csrf

                        <div class="form-group">
                            <select class="form-control" name="city_id">
                                @foreach ($cities as $city)
                                    <option value="{{ $city->id }}">{{ $city->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group text-right">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Submit') }}
                            </button>
                        </div>
                    </form> --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
