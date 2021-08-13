@extends('layouts.spa')

@section('head')
    @if(config('app.env') === 'production')
        <link rel="stylesheet" href="{{ mix('/dist/guest-app.css') }}">
    @else
        <link rel="stylesheet" href="{{ mix('/css/guest-app.css') }}">
    @endif
@endsection

@section('content')
    @if(config('app.env') === 'production')
        <script src="{{ mix('/dist/ProdGuestApp.js') }}"></script>
    @else
        <script src="{{ mix('/js/GuestApp.js') }}"></script>
    @endif
@endsection

