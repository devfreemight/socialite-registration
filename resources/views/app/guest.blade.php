@extends('layouts.spa')

@section('head')
        <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
@endsection

@section('content')
    @if(config('app.env') === 'production')
        <script src="{{ mix('/dist/ProdGuestApp.js') }}"></script>
    @else
        <script src="{{ mix('/js/GuestApp.js') }}"></script>
    @endif
@endsection

