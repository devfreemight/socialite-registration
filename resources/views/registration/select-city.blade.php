@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center select-city">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">SELECT CITY</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('user.registration') }}">
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
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
