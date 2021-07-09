@extends('layouts.spa')

@section('head')
    @if(config('app.env') === 'production')
        <link rel="stylesheet" href="{{ asset('/dist/app.css') }}">
    @else
        <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
    @endif
@endsection

@section('content')
    @if(config('app.env') === 'production')
        <script src="{{ asset('/dist/ProdGuestApp.js') }}"></script>
    @else
        <script src="{{ asset('/js/GuestApp.js') }}"></script>
    @endif
@endsection

