@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">{{ __('Registration Completed!') }}</div>

                <div class="card-body">
                    {{ __('A confirmation mail has been sent to your email.') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
