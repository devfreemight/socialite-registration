@extends('layouts.spa')

@section('head')
    @if(config('app.env') === 'production')
        <link rel="stylesheet" href="{{ asset('/dist/admin-app.css') }}">
    @else
        <link rel="stylesheet" href="{{ asset('/css/admin-app.css') }}">
    @endif
@endsection

@section('content')
    @if(config('app.env') === 'production')
        <script src="{{ asset('/dist/ProdAdminApp.js') }}"></script>
    @else
        <script src="{{ asset('/js/AdminApp.js') }}"></script>
    @endif
@endsection

